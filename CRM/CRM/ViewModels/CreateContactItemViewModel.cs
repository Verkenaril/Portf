using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace CRM
{
    internal class CreateContactItemViewModel
    {
        public MainViewModel MVM;
        public CreateContactItemView CCIV;
        public string name { get; set; }
        public string phone { get; set; }
        public string note { get; set; }
        public string company { get; set; }
        public CreateContactItemViewModel(MainViewModel mvm, CreateContactItemView cciv)
        {
            this.MVM = mvm;
            this.CCIV = cciv;
        }

        private Commands add_contact_item_command;
        public Commands AddContactItemtCommand
        {
            get
            {
                return add_contact_item_command ?? (new Commands(obj =>
                {
                    ContactItem ci = new ContactItem(this.name, this.phone, this.company, this.note, this.MVM);
                    using (var db = new MyDBContext())
                    {
                        db.Contacts.Add(ci);
                        db.SaveChanges();
                    }
                    this.MVM.contacts_initially.Add(ci);

                    CCIV.Close();
                }));
            }
        }
    }
}
