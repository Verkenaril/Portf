using System;
using System.Collections.Generic;
using System.Collections.ObjectModel;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace CRM
{
    internal class RemindersModel
    {
        public MainViewModel MVM;
        public RemindersModel(MainViewModel mvm) 
        {
            this.MVM = mvm;
        }

        public ObservableCollection<ReminderItem> reminders_coll { get; set; }

        public ObservableCollection<ReminderItem> getNotes()
        {
            using (var db = new MyDBContext())
            {
                reminders_coll = new ObservableCollection<ReminderItem>(db.Reminders.ToList());
            }
            foreach(var item in reminders_coll)
            {
                item.MVM = this.MVM;
            }
            return reminders_coll;
        }
    }
}
