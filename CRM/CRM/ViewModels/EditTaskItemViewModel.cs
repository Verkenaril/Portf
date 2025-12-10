using System;
using System.Collections.Generic;
using System.Data.Entity;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows;
using System.Windows.Controls;

namespace CRM
{
    internal class EditTaskItemViewModel
    {
        public EditTaskItemView EDTIV;
        public MainViewModel MVM;
        public TaskItem TI;

        public SelectedItem[] items { get; set; } = 
        {
            new SelectedItem(0, "Новая задача", false),
            new SelectedItem(1, "В работе", false),
            new SelectedItem(2, "На проверке", false),
            new SelectedItem(3, "Выполненная", false),
        };

        public SelectedItem selected_item { get; set; }
        public string executor { get; set; }
        public string description { get; set; }
        public EditTaskItemViewModel(MainViewModel mvm, TaskItem ti, EditTaskItemView etiv)
        {
            this.MVM = mvm;
            this.TI = ti;
            this.EDTIV = etiv;
            this.executor = ti.executor;
            this.description = ti.description;
            this.setSelectedItem();
        }

        public void setSelectedItem()
        {
            switch(this.TI.type)
            {
                case 0:
                    this.selected_item = items[0];
                    break;
                case 1:
                    this.selected_item = items[1];
                    break;
                case 2:
                    this.selected_item = items[2];
                    break;
                case 3:
                    this.selected_item = items[3];
                    break;
                default:

                    break;
            }
        }


        private Commands save_task_command;
        public Commands SaveTaskCommand
        {
            get
            {
                return save_task_command ?? (new Commands(obj =>
                {

                    this.MVM.tasks_model.removeTaskItem(this.TI);
                    this.TI.description = this.description;
                    this.TI.executor = this.executor;
                    this.TI.type = this.selected_item.type;
                    this.MVM.tasks_model.addTaskItem(this.TI);
                    this.changeInDB();

                    this.TI.OnPropertyChanged("description");
                    this.TI.OnPropertyChanged("executor");
                    this.MVM.OnPropertyChanged("tasks_in_working");
                    this.MVM.OnPropertyChanged("tasks_new");
                    this.MVM.OnPropertyChanged("tasks_complite");
                    this.MVM.OnPropertyChanged("tasks_under_review");

                    this.EDTIV.Close();
                }));
            }
        }
        public void changeInDB()
        {
            using (var db = new MyDBContext())
            {
                db.Entry(this.TI).State = EntityState.Modified;
                db.SaveChanges();
            }
        }
    }
    public class SelectedItem
    {
        public string content { get; set; }
        public int type { get; set; }
        public bool is_selected { get; set; }
        public SelectedItem(int tp, string cnt, bool sltd)
        {
            this.type = tp;
            this.content = cnt;
            this.is_selected = sltd;
        }
    }
}
