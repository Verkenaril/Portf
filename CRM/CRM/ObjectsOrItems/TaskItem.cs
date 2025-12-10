using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Linq;
using System.Runtime.CompilerServices;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace CRM
{
    internal class TaskItem : INotifyPropertyChanged
    {
        public MainViewModel MVM;
        public int id { get; set; }
        public string title { get; set; }
        public string description { get; set; }
        public string executor { get; set; }
        public DateTime period { get; set; }
        public int type { get; set; }

        public TaskItem() { }
        public TaskItem(MainViewModel mvm, string n, string d, string e, DateTime p, int t)
        {
            this.MVM = mvm;
            this.title = n;
            this.description = d;
            this.executor = e;
            this.period = p;
            this.type = t;
        }
        public TaskItem(string n, string d, string e, DateTime p, int t)
        {
            this.title = n;
            this.description = d;
            this.executor = e;
            this.period = p;
            this.type = t;
        }

        private Commands edit_task_item_command;
        public Commands EditTaskItemCommand
        {
            get
            {
                return edit_task_item_command ?? (new Commands(obj =>
                {
                    EditTaskItemView etiv = new EditTaskItemView(this.MVM, this);
                    etiv.Show();

                }));
            }
        }
        public event PropertyChangedEventHandler PropertyChanged;
        public void OnPropertyChanged([CallerMemberName] string prop = "")
        {
            PropertyChanged?.Invoke(this, new PropertyChangedEventArgs(prop));
        }
    }
}
