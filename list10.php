<?php
namespace App\Filament\Resources\Bouquets;

use App\Filament\Resources\Bouquets\Schemas\BouquetForm;
use App\Filament\Resources\Bouquets\Tables\BouquetsTable;
use App\Models\Bouquet;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class BouquetResource extends Resource
{
    protected static ?string $model = Bouquet::class;
    protected static ?string $navigationLabel = 'Букеты';

    public static function form(Schema $schema): Schema
    {
        return BouquetForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BouquetsTable::configure($table);
    }
}


<?php
// BouquetForm.php — форма создания/редактирования букета
namespace App\Filament\Resources\Bouquets\Schemas;

use Filament\Forms\Components\{TextInput, Textarea, FileUpload, Toggle};
use Filament\Schemas\Schema;

class BouquetForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('category_id')->required()->numeric(),
            TextInput::make('name')->required(),
            Textarea::make('description')->columnSpanFull(),
            TextInput::make('price')->required()->numeric()->prefix('₽'),
            FileUpload::make('image')->image(),
            Toggle::make('is_available')->required(),
        ]);
    }
}