using System;
using System.Collections.Generic;
using System.Collections.ObjectModel;
using System.ComponentModel;
using System.Data.Entity;
using System.Linq;
using System.Runtime.CompilerServices;
using System.Runtime.Remoting.Contexts;
using System.Text;
using System.Threading.Tasks;
using System.Windows;
using System.Windows.Controls;

namespace CRM
{
    internal class Client : INotifyPropertyChanged
    {
        public MainViewModel MVM;

        public int id { get; set; }
        public string name { get; set; }
        public string phone { get; set; }
        public string note { get; set; }
        public string company { get; set; }

        public Client() { }

        public Client(string n, string t, string c, string nt, MainViewModel mvm)
        {
            this.name = n;
            this.phone = t;
            this.note = nt;
            this.company = c;
            this.MVM = mvm;
        }

        private bool _isRemoving;
        public bool IsRemoving
        {
            get => _isRemoving;
            set { _isRemoving = value; OnPropertyChanged(); }
        }

        private Commands edit_contact_command;
        private Commands del_command;

        public void InitCommands(MainViewModel mvm)
        {
            this.MVM = mvm;

            //edit_contact_command = new Commands(obj =>
            //{
            //    EditContact ec = new EditContact(this);
            //    ec.Show();
            //});

            del_command = new Commands(obj =>
            {
                using (var db = new MyDBContext())
                {
                    var client = new Client();
                    client.id = this.id;
                    db.Entry(client).State = EntityState.Deleted;
                    db.SaveChanges();
                }

                IsRemoving = true;
            });
        }

        public Commands EditContactCommand => edit_contact_command;
        public Commands DelCommand => del_command;

        public event PropertyChangedEventHandler PropertyChanged;
        public void OnPropertyChanged([CallerMemberName] string prop = "")
        {
            PropertyChanged?.Invoke(this, new PropertyChangedEventArgs(prop));
        }
    }
}
