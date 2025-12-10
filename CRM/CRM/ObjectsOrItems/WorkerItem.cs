using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace CRM
{
    internal class WorkerItem
    {
        public int id { get; set; }
        public string name { get; set; }
        public string position { get; set; }
        public int status { get; set; }
        public string title_status { get; set; }    
        public string color_status { get; set; }    

        public WorkerItem() { }
        public WorkerItem(string n, string p, int s)
        {
            this.name = n;
            this.position = p;
            this.status = s;
        }
    }
}
