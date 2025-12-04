<!-- viết thử thôi - xóa đi viết lại được nhé -->
class CategoryController extends Controller
{
    public function index() {
        return view('admin.category.index');
    }

    public function create() {
        return view('admin.category.create');
    }
}
