
using System;
using System.Collections.Generic;
using System.Data.Entity.ModelConfiguration;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace CRM
{
    internal class WorkerItemConfig : EntityTypeConfiguration<WorkerItem>
    {
        public WorkerItemConfig()
        {
            ToTable("workers", "public");

            HasKey(x => x.id);

            Property(x => x.id).HasColumnName("id");
            Property(x => x.name).HasColumnName("name").HasMaxLength(255).IsOptional();
            Property(x => x.position).HasColumnName("position").HasMaxLength(255).IsOptional();
            Property(x => x.status).HasColumnName("status").IsOptional();

            Ignore(x => x.title_status);
            Ignore(x => x.color_status);
        }
        
    }
}
