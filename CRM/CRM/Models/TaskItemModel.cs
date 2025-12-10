using System;
using System.Collections.Generic;
using System.Collections.ObjectModel;
using System.Linq;
using System.Windows;
using System.Text;
using System.Threading.Tasks;

namespace CRM.Models
{
    internal class TaskItemModel
    {
        public MainViewModel MVM;
        public ObservableCollection<TaskItem> tasks { get; set; }
        public TaskItemModel(MainViewModel mvm)
        {
            this.MVM = mvm;
        }
        public ObservableCollection<TaskItem> getTasks()
        {
            using(MyDBContext db = new MyDBContext())
            {
                tasks = new ObservableCollection<TaskItem>(db.Tasks.ToList());
            }
            foreach (var item in tasks)
            {
                item.MVM = this.MVM;

                switch (item.type)
                {
                    case 0:
                        Application.Current.Dispatcher.Invoke(() => this.MVM.tasks_new.Add(item));
                        break;
                    case 1:
                        Application.Current.Dispatcher.Invoke(() => this.MVM.tasks_in_working.Add(item));
                        break;
                    case 2:
                        Application.Current.Dispatcher.Invoke(() => this.MVM.tasks_under_review.Add(item));
                        break;
                    case 3:
                        Application.Current.Dispatcher.Invoke(() => this.MVM.tasks_complete.Add(item));
                        break;
                    default:
                        break;

                }
            }
            return tasks;
        }
        public void removeTaskItem(TaskItem ti)
        {
           
                switch (ti.type)
                {
                    case 0:
                        this.MVM.tasks_new.Remove(ti);
                        break;
                    case 1:
                        this.MVM.tasks_in_working.Remove(ti);
                        break;
                    case 2:
                        this.MVM.tasks_under_review.Remove(ti);
                        break;
                    case 3:
                        this.MVM.tasks_complete.Remove(ti);
                        break;
                    default:

                        break;
                }
        }

        public void addTaskItem(TaskItem ti)
        {
            switch (ti.type)
            {
                case 0:
                    this.MVM.tasks_new.Add(ti);
                    break;
                case 1:
                    this.MVM.tasks_in_working.Add(ti);
                    break;
                case 2:
                    this.MVM.tasks_under_review.Add(ti);
                    break;
                case 3:
                    this.MVM.tasks_complete.Add(ti);
                    break;
                default:

                    break;
            }
        }
    }
}
