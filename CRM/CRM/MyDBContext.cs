using System;
using System.Data.Entity;


namespace CRM
{
    internal class MyDBContext : DbContext
    {
        public MyDBContext() : base("name=MyDbContext")
        {
        }

        public DbSet<Men> Mens { get; set; }
        public DbSet<ContactItem> Contacts { get; set; }
        public DbSet<ReminderItem> Reminders { get; set; }
        public DbSet<TaskItem> Tasks { get; set; }
        public DbSet<WorkerItem> Workers { get; set; }

        protected override void OnModelCreating(DbModelBuilder modelBuilder)
        {
            modelBuilder.Configurations.Add(new MenConfig());
            modelBuilder.Configurations.Add(new ContactConfig());
            modelBuilder.Configurations.Add(new TaskItemConfig());
            modelBuilder.Configurations.Add(new WorkerItemConfig());
            modelBuilder.Configurations.Add(new ReminderItemConfig());
            base.OnModelCreating(modelBuilder);
        }
    }
}
