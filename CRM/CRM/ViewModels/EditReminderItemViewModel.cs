using System;
using System.Collections.Generic;
using System.Data.Entity;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows;

namespace CRM
{
    internal class EditReminderItemViewModel
    {
        public MainViewModel MVM;
        public ReminderItem RM;
        public EditReminderItemView ERIV;
        public string title { get; set; }
        public string content { get; set; }
        public EditReminderItemViewModel(MainViewModel mvm, ReminderItem rm, EditReminderItemView eriv)
        {
            this.MVM = mvm;
            this.RM = rm;
            this.title = this.RM.title;
            this.content = this.RM.content;
            this.ERIV = eriv;
        }
        private Commands save_note_command;
        public Commands SaveNoteCommand
        {
            get
            {
                return save_note_command ?? (new Commands(obj =>
                {
                    this.RM.content = this.content;
                    this.RM.title = this.title;
                    using (var db = new MyDBContext())
                    {
                        db.Entry(this.RM).State = EntityState.Modified;
                        db.SaveChanges();
                    }
                    this.RM.OnPropertyChanged("title");
                    this.RM.OnPropertyChanged("content");
                    ERIV.Close();
                }));
            }
        }
    }
}
