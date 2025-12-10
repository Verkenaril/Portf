using System;
using System.Collections.Generic;
using System.Data.Entity;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace CRM
{
    internal class EditContactItemViewModel
    {
        public MainViewModel MVM;
        public ContactItem CI;
        public EditContactItemView ECIV;

        public int id { get; set; }
        public string name { get; set; }
        public string phone { get; set; }
        public string note { get; set; }
        public string company { get; set; }
        public EditContactItemViewModel(MainViewModel mvm, ContactItem ci, EditContactItemView eciv)
        {
            this.MVM = mvm;
            this.CI = ci;
            this.ECIV = eciv;
            this.id = ci.id;
            this.name = ci.name;
            this.phone = ci.phone;
            this.note = ci.note;
            this.company = ci.company;
        }
        private Commands save_command;
        public Commands SaveCommand
        {
            get
            {
                return save_command ??
                    new Commands(obj =>
                    {
                        // записываем обратно
                        this.CI.name = this.name;
                        this.CI.phone = this.phone;
                        this.CI.note = this.note;
                        this.CI.company = this.company;

                        // уведомляем WPF, что ВСЕ свойства клиента изменены
                        this.CI.OnPropertyChanged("name");
                        this.CI.OnPropertyChanged("phone");
                        this.CI.OnPropertyChanged("note");
                        this.CI.OnPropertyChanged("company");


                        using (var db = new MyDBContext())
                        {
                            db.Entry(this.CI).State = EntityState.Modified;
                            db.SaveChanges();
                        }

                        this.ECIV.Close();
                    });
            }
        }
    }
}
