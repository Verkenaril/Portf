using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows;

namespace CRM
{
    internal class LoginRegistrationViewModel
    {
        public string login_input { get; set; }
        public string password_input { get; set; }
        public LoginRegistrationView LRV;

        public LoginRegistrationViewModel(LoginRegistrationView lrv)
        {
            this.LRV = lrv;
        }

        private Commands login_command;
        public Commands LoginCommand
        {
            get
            {
                return login_command ?? (new Commands(obj =>
                {
                    if (login_input == "admin" && password_input == "admin")
                    {
                        MainWindow MW = new MainWindow();
                        MW.Show();
                        this.LRV.Close();
                    }
                    
                }));
            }
        }
    }
}
