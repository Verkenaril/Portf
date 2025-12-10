using System;
using System.Collections.Generic;
using System.Data.Entity.ModelConfiguration;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace CRM
{
    internal class MenConfig : EntityTypeConfiguration<Men>
    {
        public MenConfig()
        {
            ToTable("mens", "public");           // имя таблицы в БД

            HasKey(x => x.Id);         // первичный ключ

            Property(x => x.Id)
                .HasColumnName("id");

            Property(x => x.Name)
                .HasColumnName("name")
                .HasMaxLength(255)     // можно уменьшить, если у тебя другой размер
                .IsOptional();         // если NOT NULL → .IsRequired()
        }

    }
}
