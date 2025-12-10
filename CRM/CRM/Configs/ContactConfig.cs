using System;
using System.Collections.Generic;
using System.Data.Entity.ModelConfiguration;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace CRM
{
  internal class ContactConfig : EntityTypeConfiguration<ContactItem>
    {
        public ContactConfig()
        {
            ToTable("contacts", "public");           // имя таблицы в БД

            HasKey(x => x.id);         // первичный ключ

            Property(x => x.id)
                .HasColumnName("id");

            Property(x => x.name)
                .HasColumnName("name")
                .HasMaxLength(255)     // можно уменьшить, если у тебя другой размер
                .IsOptional();         // если NOT NULL → .IsRequired()


            Property(x => x.phone)
               .HasColumnName("phone")
               .HasMaxLength(255)     // можно уменьшить, если у тебя другой размер
               .IsOptional();

            Property(x => x.company)
               .HasColumnName("company")
               .HasMaxLength(255)     // можно уменьшить, если у тебя другой размер
               .IsOptional();

            Property(x => x.note)
               .HasColumnName("note")
               .HasMaxLength(255)  // можно уменьшить, если у тебя другой размер
               .IsOptional();

            //Ignore(x => x.IsRemoving);

        }

    }
}
