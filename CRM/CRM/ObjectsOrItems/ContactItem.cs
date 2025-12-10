using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data.Entity;
using System.Linq;
using System.Runtime.CompilerServices;
using System.Text;
using System.Threading.Tasks;
using System.Windows;

namespace CRM
{
    internal class ContactItem : INotifyPropertyChanged
    {
        public MainViewModel MVM;
        public int id { get; set; }
        public string name { get; set; }
        public string phone { get; set; }
        public string note { get; set; }
        public string company { get; set; }

        public ContactItem() { }

        public ContactItem(string n, string p, string c, string nt, MainViewModel mvm)
        {
            this.name = n;
            this.phone = p;
            this.note = nt;
            this.company = c;
            this.MVM = mvm;
        }

        private Commands edit_contact_command;
        public Commands EditContactCommand
        {
            get
            {
                return edit_contact_command ?? (new Commands(obj =>
                {
                    EditContactItemView eciv = new EditContactItemView(this.MVM, this);
                    eciv.Show();
                }));
            }
        }
        private Commands delete_contact_item;
        public Commands DeleteContactCommand
        {
            get
            {
                return delete_contact_item ?? (new Commands(obj =>
                {
                    using (var db = new MyDBContext())
                    {
                        var contact = new ContactItem();
                        contact.id = this.id;
                        db.Entry(contact).State = EntityState.Deleted;
                        db.SaveChanges();
                    }
                    this.MVM.contacts_initially.Remove(this);
                    OnPropertyChanged("contacts_to_view");
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
