<?php
// app/Http/Controllers/AdminController.php
namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Member;
use GroceryCrud\Core\GroceryCrud;
use App\Models\Transaction;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminController extends Controller
{
    /**
     * Grocery CRUD Example
     *
     * @return \Illuminate\Http\Response|\Illuminate\View\View
     */

    public function transaction()
    {
        if (auth()->user()->role('officer')) {
            $books = Book::all();
            $members = Member::all();
            return view('admin.transaction.index', compact('books', 'members'));
        } else {
            return abort('403');
            // }
            // $role = Role::create(['name' => 'officer']);
            // $permission = Permission::create(['name' => 'index transactions']);

            // $role->givePermissionTo($permission);
            // $permission->assignRole($role);

            // $user = auth()->user();
            // $user->assignRole('officer');

            // $user = User::with('roles')->get();

            // $user = User::where('id', 2)->first();
            // $user->removeRole('officer');
            //return $user;
        }
    }
    public function customers()
    {
        $crud = $this->_getGroceryCrudEnterprise();

        $crud->setTable('customers');
        $crud->setSubject('Customer', 'Customers');

        $output = $crud->render();

        return $this->_showOutput($output);
    }

    /**
     * Get everything we need in order to load Grocery CRUD
     *
     * @return GroceryCrud
     * @throws \GroceryCrud\Core\Exceptions\Exception
     */
    private function _getGroceryCrudEnterprise()
    {
        $database = $this->_getDatabaseConnection();
        $config = config('grocerycrud');

        $crud = new GroceryCrud($config, $database);

        return $crud;
    }

    /**
     * Grocery CRUD Output
     *
     * @return \Illuminate\Http\Response|\Illuminate\View\View
     */
    private function _showOutput($output)
    {
        if ($output->isJSONResponse) {
            return response($output->output, 200)
                ->header('Content-Type', 'application/json')
                ->header('charset', 'utf-8');
        }

        $css_files = $output->css_files;
        $js_files = $output->js_files;
        $output = $output->output;

        return view('default_template', [
            'output' => $output,
            'css_files' => $css_files,
            'js_files' => $js_files
        ]);
    }

    /**
     * Get database credentials as a Zend Db Adapter configuration
     * @return array[]
     */
    private function _getDatabaseConnection()
    {

        return [
            'adapter' => [
                'driver' => 'Pdo_Mysql',
                'database' => env('DB_DATABASE'),
                'username' => env('DB_USERNAME'),
                'password' => env('DB_PASSWORD'),
                'charset' => 'utf8'
            ]
        ];
    }
}
