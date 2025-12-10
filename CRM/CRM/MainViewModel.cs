using CRM.Models;
using LiveCharts;
using LiveCharts.Wpf;
using Npgsql;
using System;

using System.Collections.ObjectModel;
using System.ComponentModel;
using System.Linq;
using System.Reflection;
using System.Runtime.CompilerServices;

using System.Threading.Tasks;
using System.Windows;
using System.Windows.Input;

using System.Windows.Media;

namespace CRM
{
    internal class MainViewModel : INotifyPropertyChanged
    {
        public ObservableCollection<ReminderItem> reminders_to_view { get; set; }
        public ObservableCollection<ReminderItem> reminders { get; set; } = new ObservableCollection<ReminderItem>();
        public ObservableCollection<ContactItem> contacts_initially { get; set; } = new ObservableCollection<ContactItem>();
        public ObservableCollection<ContactItem> contacts_to_view { get; set; } = new ObservableCollection<ContactItem>();
        public ObservableCollection<TaskItem> all_tasks { get; set; }
        public ObservableCollection<TaskItem> tasks_in_working { get; set; }
        public ObservableCollection<TaskItem> tasks_new { get; set; }
        public ObservableCollection<TaskItem> tasks_complete { get; set; }
        public ObservableCollection<TaskItem> tasks_under_review { get; set; }

        public ObservableCollection<ToolTip> tlp { get; set; } = new ObservableCollection<ToolTip>();
        public ObservableCollection<ToolTip> tlp_for_workers { get; set; } = new ObservableCollection<ToolTip>();
        public ObservableCollection<ToolTip> tlp_for_projects{ get; set; } = new ObservableCollection<ToolTip>();

        public ObservableCollection<WorkerItem> workers { get; set; } = new ObservableCollection<WorkerItem>();

        public Action PlayAnimation { get; set; }

        public ContactsModel contacts_model;
        public TaskItemModel tasks_model;
        public string text_box_input { get; set; }


        public ICommand TabContactsActivatedCommand { get; }



        public SeriesCollection MySeries { get; set; } = new SeriesCollection();
        public SeriesCollection projects_chart { get; set; } = new SeriesCollection();
        public SeriesCollection workers_chart { get; set; } = new SeriesCollection();





        public MainViewModel()
        {

            this.tasks_in_working = new ObservableCollection<TaskItem>();
            this.tasks_under_review = new ObservableCollection<TaskItem>();
            this.tasks_new = new ObservableCollection<TaskItem>();
            this.tasks_complete = new ObservableCollection<TaskItem>();
            this.all_tasks = new ObservableCollection<TaskItem>();


//-------------------------------------------------start example data-------------------------------------------
//-------------------------------------------------start example data-------------------------------------------
//-------------------------------------------------start example data-------------------------------------------
//-------------------------------------------------start example data-------------------------------------------
//-------------------------------------------------start example data-------------------------------------------
//-------------------------------------------------start example data-------------------------------------------
           




            workers.Add(new WorkerItem("Иван Иванов", "Менеджер", 0));
            workers.Add(new WorkerItem("Анна Каренина", "Помощник машиниста", 0));
            workers.Add(new WorkerItem("Ника Васина", "Секретарь", 1));
            workers.Add(new WorkerItem("Тини Грузе", "Менеджер", 2));
            workers.Add(new WorkerItem("Иван Грозный", "Царь", 1));
            workers.Add(new WorkerItem("Владимир Красной", "Страший специалист", 2));
            workers.Add(new WorkerItem("Павел Гремов", "Специалист", 0));
            workers.Add(new WorkerItem("Никита Егоров", "Инженер", 1));
            workers.Add(new WorkerItem("Екатерина Скворцова", "Секретарь", 2));
            workers.Add(new WorkerItem("Семён Скворцов", "Инженер", 4));
            workers.Add(new WorkerItem("Елизавета Смирнова", "Менеджер", 3));
            workers.Add(new WorkerItem("Юля Капустина", "Секретарь", 2));
            workers.Add(new WorkerItem("Александра Вострикова", "Младший специалист", 4));
            workers.Add(new WorkerItem("Анна Столярова", "Юрист", 1));
            workers.Add(new WorkerItem("Пётр Дмитров", "Юрист", 4));

            int[] counter_status = new int[6];

            foreach (var item in workers)
            {
                switch(item.status)
                {
                    case 0:
                        item.title_status = "Отсутствует";
                        item.color_status = "Red";
                        counter_status[0]++;
                        break;
                    case 1:
                        item.title_status = "На работе";
                        item.color_status = "Green";
                        counter_status[1]++;
                        break;
                    case 2:
                        item.title_status = "В отпуске";
                        item.color_status = "Orange";
                        counter_status[2]++;
                        break;
                    case 3:
                        item.title_status = "На больничном";
                        item.color_status = "Indigo";
                        counter_status[3]++;
                        break;
                    case 4:
                        item.title_status = "В командировке";
                        item.color_status = "Aqua";
                        counter_status[4]++;
                        break;
                }
            }
            counter_status[5] = counter_status.Sum();
            workers_chart.Add(new PieSeries { Title = "Отсутствует", Values = new ChartValues<double>() { counter_status[0] }, Fill = new SolidColorBrush { Color = (Color)ColorConverter.ConvertFromString("Red") } });
            workers_chart.Add(new PieSeries { Title = "На работе", Values = new ChartValues<double>() { counter_status[1] }, Fill = new SolidColorBrush { Color = (Color)ColorConverter.ConvertFromString("Green") } });
            workers_chart.Add(new PieSeries { Title = "В отпуске", Values = new ChartValues<double>() { counter_status[2] }, Fill = new SolidColorBrush { Color = (Color)ColorConverter.ConvertFromString("Orange") } });
            workers_chart.Add(new PieSeries { Title = "На больничном", Values = new ChartValues<double>() { counter_status[3] }, Fill = new SolidColorBrush { Color = (Color)ColorConverter.ConvertFromString("Indigo") } });
            workers_chart.Add(new PieSeries { Title = "В командировке", Values = new ChartValues<double>() { counter_status[4] }, Fill = new SolidColorBrush { Color = (Color)ColorConverter.ConvertFromString("Aqua") } });

            tlp_for_workers.Add(new ToolTip("Отсутствует", "Red", counter_status[0], 100 * counter_status[0]  / counter_status[5]));
            tlp_for_workers.Add(new ToolTip("На работе", "Green", counter_status[1], 100 * counter_status[1]  / counter_status[5]));
            tlp_for_workers.Add(new ToolTip("В отпуске", "Orange", counter_status[2], 100 * counter_status[2]  / counter_status[5]));
            tlp_for_workers.Add(new ToolTip("На больничном", "Indigo", counter_status[3], 100 * counter_status[3]  / counter_status[5]));
            tlp_for_workers.Add(new ToolTip("В командировке", "Aqua", counter_status[4], 100 * counter_status[4]  / counter_status[5]));



            projects_chart.Add(new PieSeries { Title = "Завершённые", Values = new ChartValues<double>() { 23 }, Fill = new SolidColorBrush { Color = (Color)ColorConverter.ConvertFromString("Green") } });
            projects_chart.Add(new PieSeries { Title = "Новые", Values = new ChartValues<double>() { 75 }, Fill = new SolidColorBrush { Color = (Color)ColorConverter.ConvertFromString("Red") } });
            projects_chart.Add(new PieSeries { Title = "В работе", Values = new ChartValues<double>() { 93 }, Fill = new SolidColorBrush { Color = (Color)ColorConverter.ConvertFromString("Blue") } });

            tlp_for_projects.Add(new ToolTip("Завершённые", "Green", 23, 100*23 / (23+75+93)));
            tlp_for_projects.Add(new ToolTip("Новые", "Red", 75, 100*75 / (23+75+93)));
            tlp_for_projects.Add(new ToolTip("В работе", "Blue", 93, 100*93 / (23+75+93)));





//-------------------------------------------------end example data-------------------------------------------
//-------------------------------------------------end example data-------------------------------------------
//-------------------------------------------------end example data-------------------------------------------
//-------------------------------------------------end example data-------------------------------------------
//-------------------------------------------------end example data-------------------------------------------
//-------------------------------------------------end example data-------------------------------------------

            this.reminders_to_view = this.reminders;
            this.contacts_model = new ContactsModel(this);
            this.tasks_model = new TaskItemModel(this);
            firstLoad();
            //Эта строка нужна для первичного обращения 


            TabContactsActivatedCommand = new Commands(_ => RefreshClients());
        }

        async private void firstLoad()
        {
            await Task.Run(() =>
            {
                this.contacts_model.getContacts();
                this.all_tasks = this.tasks_model.getTasks();



                Application.Current.Dispatcher.Invoke(() =>
                {
                    MySeries.Add(new PieSeries { Title = "Новые задачи", Values = new ChartValues<double> { this.tasks_new.Count }, Fill = new SolidColorBrush { Color = Color.FromRgb(255, 143, 7), Opacity = 1 } });
                    tlp.Add(new ToolTip("Новые задачи", "#FFFF8F07", this.tasks_new.Count, 100 * this.tasks_new.Count / this.all_tasks.Count));
                });
                Application.Current.Dispatcher.Invoke(() =>
                {
                    MySeries.Add(new PieSeries { Title = "В работе", Values = new ChartValues<double> { this.tasks_in_working.Count }, Fill = new SolidColorBrush { Color = Color.FromRgb(44, 144, 255), Opacity = 1 } });
                    tlp.Add(new ToolTip("В работе", "#FF2C86FF", this.tasks_in_working.Count, 100 * this.tasks_in_working.Count / this.all_tasks.Count));

                });
                Application.Current.Dispatcher.Invoke(() =>
                {
                    MySeries.Add(new PieSeries { Title = "На проверке", Values = new ChartValues<double> { this.tasks_under_review.Count }, Fill = new SolidColorBrush { Color = Color.FromRgb(238, 239, 25), Opacity = 1 } });
                    tlp.Add(new ToolTip("На проверке", "#FFEEEF19", this.tasks_under_review.Count, 100 * this.tasks_under_review.Count / this.all_tasks.Count));
                });
                Application.Current.Dispatcher.Invoke(() =>
                {
                    MySeries.Add(new PieSeries { Title = "Выполненные", Values = new ChartValues<double> { this.tasks_complete.Count }, Fill = new SolidColorBrush { Color = Color.FromRgb(0, 160, 11), Opacity = 1 } });
                    tlp.Add(new ToolTip("Выполненные", "#FF00A00B", this.tasks_complete.Count, 100 * this.tasks_complete.Count / this.all_tasks.Count));
                });







                this.reminders = (new RemindersModel(this)).getNotes();
                this.reminders_to_view = this.reminders;

                OnPropertyChanged("contacts_to_view");
                OnPropertyChanged("reminders_to_view");
            });
            
        }

        private void RefreshClients()
        {
            //Эта строка нужна для повторного обращения  к вкладке
            OnPropertyChanged("contacts_to_view");
        }

        private Commands search_client_commad;
        public Commands SearchClientCommand
        {
            get
            {
                return search_client_commad ?? new Commands(obj =>
                {
                   
                    this.contacts_to_view = this.contacts_model.searchContacts(contacts_initially, text_box_input);
                    PlayAnimation?.Invoke();
                    OnPropertyChanged("contacts_to_view");

                });
            }
        }


        private Commands create_contact_command;
        public Commands CreateContactCommand
        {
            get
            {
                return create_contact_command ?? (create_contact_command = new Commands(obj =>
                {
                    CreateContactItemView cciv= new CreateContactItemView(this);
                    cciv.Show();
                }));
            }
        }


        private Commands call_create_reminder_command;
        public Commands CallCreateReminderCommand
        {
            get
            {
                return call_create_reminder_command ?? (new Commands(obj =>
                {
                    CreateReminderItem cri = new CreateReminderItem(this, obj.ToString());
                    cri.Show();
                }));
            }
        }


















        public event PropertyChangedEventHandler PropertyChanged;
        public void OnPropertyChanged([CallerMemberName] string prop = "")
        {
            PropertyChanged?.Invoke(this, new PropertyChangedEventArgs(prop));
        }
    }


    public class ToolTip
    {
        public string title {get; set;}
        public string color { get; set; }
        public int quantity { get; set; }
        public int percent { get; set; }
        public ToolTip(string t, string c, int q, int p)
        {
            this.color = c;
            this.title = t;
            this.quantity = q;
            this.percent = p;
        }
    }
}
