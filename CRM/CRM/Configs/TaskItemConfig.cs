using System;
using System.Collections.Generic;
using System.Data.Entity.ModelConfiguration;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace CRM
{
    internal class TaskItemConfig : EntityTypeConfiguration<TaskItem>
    {
        public TaskItemConfig()
        {
            ToTable("tasks", "public");           // имя таблицы в БД

            HasKey(x => x.id);         // первичный ключ

            Property(x => x.id).HasColumnName("id");

            Property(x => x.title)
                .HasColumnName("title")
                .HasMaxLength(255)     // можно уменьшить, если у тебя другой размер
                .IsOptional();         // если NOT NULL → .IsRequired()


            Property(x => x.description)
               .HasColumnName("description")
               .HasMaxLength(255)     // можно уменьшить, если у тебя другой размер
               .IsOptional();

            Property(x => x.executor)
               .HasColumnName("executor")
               .HasMaxLength(255)     // можно уменьшить, если у тебя другой размер
               .IsOptional();

            Property(x => x.type)
            .HasColumnName("type")
            // можно уменьшить, если у тебя другой размер
            .IsOptional();

            Property(x => x.period)
           .HasColumnName("period")
           // можно уменьшить, если у тебя другой размер
           .IsOptional();

        }

    }
}
