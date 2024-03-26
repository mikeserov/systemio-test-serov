<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240324164403 extends AbstractMigration
{
    public function down(Schema $schema): void
    {
    }

    public function up(Schema $schema): void
    {
        $this->addSql("
            INSERT INTO product (id, price, name) VALUES
                ((SELECT NEXTVAL('product_id_seq')), 100, 'Iphone'),
                ((SELECT NEXTVAL('product_id_seq')), 20, 'Наушники'),
                ((SELECT NEXTVAL('product_id_seq')), 10, 'Чехол')
        ");
    }
}
