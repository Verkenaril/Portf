using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Data.Entity.ModelConfiguration;
namespace CRM
{
    internal class ReminderItemConfig : EntityTypeConfiguration<ReminderItem>
    {
        public ReminderItemConfig()
        {
            ToTable("notes", "public");

            HasKey(x => x.id);

            Property(x => x.id).HasColumnName("id");
            Property(x => x.title).HasColumnName("title").HasMaxLength(255).IsOptional();
            Property(x => x.content).HasColumnName("content").HasMaxLength(255).IsOptional();
            Property(x => x.color).HasColumnName("color").HasMaxLength(255).IsOptional();

        }
    }
}
