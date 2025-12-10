using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data.Entity;
using System.Linq;
using System.Runtime.CompilerServices;
using System.Text;
using System.Threading.Tasks;

namespace CRM
{
    internal class ReminderItem : INotifyPropertyChanged
    {
        public MainViewModel MVM;
        public int id { get; set; }
        public string title { get; set; }
        public string content { get; set; }
        public string color { get; set; }

        public ReminderItem() { }
        public ReminderItem(string t, string d, string clr)
        {
            this.title = t;
            this.content = d;
            this.color = clr;
        }


        private Commands edit_note_command;
        public Commands EditNoteCommand
        {
            get
            {
                return edit_note_command ?? (new Commands(obj =>
                {
                    var eriv = new EditReminderItemView(this.MVM, this);
                    eriv.Show();
                }));
            }
        }

        private Commands delete_note_command;
        public Commands DeleteNoteCommand
        {
            get
            {
                return delete_note_command ?? (new Commands(obj =>
                {
                    using (var db = new MyDBContext())
                    {
                        var reminer_item = new ReminderItem();
                        reminer_item.id = this.id;
                        db.Entry(reminer_item).State = EntityState.Deleted;
                        db.SaveChanges();
                    }
                    this.MVM.reminders.Remove(this);
                    this.MVM.OnPropertyChanged("reminders_to_view");
                    System.Windows.MessageBox.Show("1212");
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
