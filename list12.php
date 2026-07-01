<?php
namespace App\Filament\Resources\Flowers;

use App\Filament\Resources\Flowers\Schemas\FlowerForm;
use App\Filament\Resources\Flowers\Tables\FlowersTable;
use App\Models\Flower;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class FlowerResource extends Resource
{
    protected static ?string $model = Flower::class;
    protected static ?string $navigationLabel = 'Цветы';

    public static function form(Schema $schema): Schema
    {
        return FlowerForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FlowersTable::configure($table);
    }
}


<?php
// FlowerForm.php — форма цветка для конструктора
namespace App\Filament\Resources\Flowers\Schemas;

use Filament\Forms\Components\{TextInput, FileUpload};
use Filament\Schemas\Schema;

class FlowerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('name')->required(),
            TextInput::make('color'),
            TextInput::make('price')->required()->numeric()->prefix('₽'),
            TextInput::make('stock')->required()->numeric()->default(0),
            FileUpload::make('image')->image(),
        ]);
    }
}