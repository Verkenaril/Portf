using System;
using System.Collections.Generic;
using System.Collections.ObjectModel;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace CRM
{
    internal class ContactsModel
    {
        public ObservableCollection<ContactItem> contacts_searched = new ObservableCollection<ContactItem>();

        public MainViewModel MVM;

        public ContactsModel(MainViewModel mvm)
        {
            this.MVM = mvm;
        }

        public void getContacts()
        {
            using (var db = new MyDBContext())
            {
                this.MVM.contacts_initially = new ObservableCollection<ContactItem>(db.Contacts.ToList());
                foreach(var item in this.MVM.contacts_initially)
                {
                    item.MVM = this.MVM;
                }
                this.MVM.contacts_to_view = this.MVM.contacts_initially;
                this.MVM.OnPropertyChanged("contacts_to_view");
            }
        }
        public ObservableCollection<ContactItem> searchContacts(ObservableCollection<ContactItem> c, string input)
        {
            contacts_searched.Clear();
            for (int i = 0; i < c.Count; i++)
            {
                if (input == null || input == "")
                {
                    contacts_searched.Add(c.ElementAt(i));
                }
                else if ((c.ElementAt(i).note ?? "").Contains(input) || (c.ElementAt(i).name ?? "").Contains(input) || (c.ElementAt(i).phone ?? "").Contains(input) || (c.ElementAt(i).company ?? "").Contains(input))
                {
                    contacts_searched.Add(c.ElementAt(i));
                }
            }
            return contacts_searched;
        }
    }
}
