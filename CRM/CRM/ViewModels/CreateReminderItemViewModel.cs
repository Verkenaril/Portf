using System;
using System.Collections.Generic;
using System.Collections.ObjectModel;
using System.Diagnostics.Contracts;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace CRM
{
    internal class CreateReminderItemViewModel
    {
        public string title { get; set; }
        public CreateReminderItem create_reminder_item_window;
        public string content { get; set; }
        public MainViewModel MVM;
        public string BG;
        public CreateReminderItemViewModel(MainViewModel mvm, string bg, CreateReminderItem w)
        {
            this.MVM = mvm;
            this.BG = bg;
            this.create_reminder_item_window = w;
        }




        private Commands create_reminder_command;
        public Commands CreateReminderCommand
        {
            get
            {
                return create_reminder_command ?? (new Commands(obj =>
                {
                    ReminderItem note = new ReminderItem(this.title, this.content, this.BG);
                    this.MVM.reminders.Add(note);
                    using (var db = new MyDBContext())
                    {
                        db.Reminders.Add(note);
                        db.SaveChanges();
                    }
                    this.create_reminder_item_window.Close();
                }));
            }
        }
    }
}
