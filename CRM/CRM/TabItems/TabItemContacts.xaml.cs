using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows;
using System.Windows.Controls;
using System.Windows.Data;
using System.Windows.Documents;
using System.Windows.Input;
using System.Windows.Media;
using System.Windows.Media.Animation;
using System.Windows.Media.Imaging;
using System.Windows.Navigation;
using System.Windows.Shapes;

namespace CRM
{
    /// <summary>
    /// Логика взаимодействия для TabItemContacts.xaml
    /// </summary>
    /// 
    public partial class TabItemContacts : UserControl
    {
        internal MainViewModel mvm;
        public TabItemContacts()
        {
            InitializeComponent();
            DataContextChanged += (s, e) =>
            {
                if (e.NewValue is MainViewModel vm) vm.PlayAnimation = PlayAnimation;
            };


        }
        private void PlayAnimation()
        {
            var sb = (Storyboard)ClientsList.Resources["FadeInStoryboard"];
            ClientsList.BeginStoryboard(sb);
        }
    }

}
