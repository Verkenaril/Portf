using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Windows;
using System.Windows.Controls;
using System.Windows.Media.Animation;
using System.Windows.Threading;

namespace CRM
{
    public static class AnimatedRemovalBehavior
    {
        public static readonly DependencyProperty EnableProperty =
            DependencyProperty.RegisterAttached(
                "Enable",
                typeof(bool),
                typeof(AnimatedRemovalBehavior),
                new PropertyMetadata(false, OnEnableChanged));

        // Внешний доступ
        public static void SetEnable(DependencyObject element, bool value) => element.SetValue(EnableProperty, value);
        public static bool GetEnable(DependencyObject element) => (bool)element.GetValue(EnableProperty);

        // Хранилище подписок, чтобы можно было отписаться
        private static readonly Dictionary<ItemsControl, List<INotifyPropertyChanged>> _tracked =
            new Dictionary<ItemsControl, List<INotifyPropertyChanged>>();

        private static void OnEnableChanged(DependencyObject d, DependencyPropertyChangedEventArgs e)
        {
            if (!(d is ItemsControl itemsControl)) return;

            bool enabled = (bool)e.NewValue;
            if (enabled)
            {
                itemsControl.Loaded += ItemsControl_Loaded;
                // на изменение генератора контейнеров — чтобы подписаться на поздно сгенерированные элементы
                itemsControl.ItemContainerGenerator.StatusChanged += (s, ev) => AttachPropertyHandlers(itemsControl);
                AttachPropertyHandlers(itemsControl);
            }
            else
            {
                itemsControl.Loaded -= ItemsControl_Loaded;
                DetachAll(itemsControl);
            }
        }

        private static void ItemsControl_Loaded(object sender, RoutedEventArgs e)
        {
            AttachPropertyHandlers(sender as ItemsControl);
        }

        private static void AttachPropertyHandlers(ItemsControl itemsControl)
        {
            if (itemsControl == null) return;

            // Удаляем старые подписки (если есть)
            DetachAll(itemsControl);

            var list = new List<INotifyPropertyChanged>();
            _tracked[itemsControl] = list;

            foreach (var item in itemsControl.Items)
            {
                if (item is INotifyPropertyChanged inpc)
                {
                    list.Add(inpc);
                    inpc.PropertyChanged += (s, ev) => ClientPropertyChanged(itemsControl, s as INotifyPropertyChanged, ev);
                }
            }
        }

        private static void DetachAll(ItemsControl itemsControl)
        {
            if (!_tracked.TryGetValue(itemsControl, out var list)) return;
            foreach (var inpc in list)
            {
                try
                {
                    inpc.PropertyChanged -= (s, ev) => ClientPropertyChanged(itemsControl, s as INotifyPropertyChanged, ev);
                }
                catch { /* ignore */ }
            }
            _tracked.Remove(itemsControl);
        }

        private static void ClientPropertyChanged(ItemsControl itemsControl, INotifyPropertyChanged obj, PropertyChangedEventArgs ev)
        {
            // Подождём немного в диспетчере — иногда контейнер ещё не сгенерирован
            if (ev.PropertyName == "IsRemoving" || string.IsNullOrEmpty(ev.PropertyName))
            {
                itemsControl.Dispatcher.BeginInvoke(new Action(() =>
                {
                    // найдём элемент-объект в Items
                    foreach (var item in itemsControl.Items)
                    {
                        if (!ReferenceEquals(item, obj)) continue;

                        // Получаем контейнер (ContentPresenter)
                        var container = itemsControl.ItemContainerGenerator.ContainerFromItem(item) as FrameworkElement;

                        if (container == null)
                        {
                            // Если контейнер ещё не создан — попробуем позже
                            itemsControl.Dispatcher.BeginInvoke(new Action(() => ClientPropertyChanged(itemsControl, obj, ev)), DispatcherPriority.Loaded);
                            return;
                        }

                        // Проверяем значение IsRemoving через reflection (потому что это конкретный тип Client)
                        var prop = obj.GetType().GetProperty("IsRemoving");
                        if (prop == null) return;
                        var val = prop.GetValue(obj);
                        if (val is bool b && b)
                        {
                            // Запускаем анимацию
                            StartFadeOutAndRemove(itemsControl, container, item);
                        }

                        break;
                    }
                }), DispatcherPriority.Background);
            }
        }

        private static void StartFadeOutAndRemove(ItemsControl itemsControl, FrameworkElement container, object item)
        {
            // Создадим анимацию
            var anim = new DoubleAnimation
            {
                To = 0.0,
                Duration = TimeSpan.FromMilliseconds(200),
                FillBehavior = FillBehavior.Stop
            };

            // Сохраним текущее значение opacity, чтобы вернуть, если нужно
            double originalOpacity = container.Opacity;

            anim.Completed += (s, e) =>
            {
                // Установим видимость в 0 и окончательно удалим элемент из коллекции (через MainViewModel.FinishRemove если есть)
                container.Opacity = 0;

                // Попробуем вызвать FinishRemove в DataContext (MainViewModel)
                var itemsControlVm = itemsControl.DataContext;
                if (itemsControlVm != null)
                {
                    var method = itemsControlVm.GetType().GetMethod("FinishRemove");
                    if (method != null)
                    {
                        try
                        {
                            method.Invoke(itemsControlVm, new[] { item });
                            return;
                        }
                        catch { /* ignore */ }
                    }
                }

                // Если FinishRemove нет — попытаемся удалить напрямую, если ItemsSource — ObservableCollection<T>
                var itemsSource = itemsControl.ItemsSource;
                if (itemsSource is System.Collections.IList list)
                {
                    try
                    {
                        list.Remove(item);
                    }
                    catch { /* ignore */ }
                }

                // При желании можно вернуть opacity у контейнера (но он будет пересоздан/удален)
            };

            container.BeginAnimation(UIElement.OpacityProperty, anim);
        }
    }
}

