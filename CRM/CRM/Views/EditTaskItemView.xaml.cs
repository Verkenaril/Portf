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
using System.Windows.Media.Imaging;
using System.Windows.Shapes;

namespace CRM
{
    /// <summary>
    /// Логика взаимодействия для EditTaskItemView.xaml
    /// </summary>
    public partial class EditTaskItemView : Window
    {

        internal EditTaskItemView(MainViewModel mvm, TaskItem ti)
        {
            InitializeComponent();
            DataContext = new EditTaskItemViewModel(mvm, ti, this);
        }
    }
}
