<?php
namespace App\Controllers\Auth;


use CodeIgniter\Controller;
use Config\Services;
use App\Models\GroupModel;

class GroupsController extends Controller
{

	protected $session;
	protected $config;

    //--------------------------------------------------------------------

	public function __construct()
	{
		$this->session = Services::session();

	}

        
	public function Groups()
	{

		$groups= new GroupModel();
		$allgroups = $groups->findall(); 
		$totalgroups = $groups->countAll(); 

		if (! $this->session->isLoggedIn) {
			return redirect()->route('public/login');
		}

		return view('auth/groups', [
			'userData' => $this->session->userData,
			'data' => $allgroups,
			'totalgroups' => $totalgroups,
		]);
	}

    public function editgroups()
	{

		// check if user is signed-in if not redirect to login page
		if (! $this->session->isLoggedIn) {
			return redirect()->route('login');
		}

		// get the user id
		$id = $this->request->uri->getSegment(3);

		// load user model
        $groups = new GroupModel();

		// get user data using the id
		$group = $groups->where('id', $id)->first(); 


		//echo '<pre>';
		//print_r($userinfo); exit;

		// load the view with session data
		return view('auth/edits/edit-group', [
				'userData' => $this->session->userData, 
				'data' => $group
			]);
	}

	public function update()
	{
		// update user, validation happens in model
		$groups = new GroupModel();
		$getRule = $groups->getRule('cadastro');
		$groups->setValidationRules($getRule);

		$group = [
			'id'  	        => $this->session->get('id'),
			'groupname' 	=> $this->request->getPost('groupname'),
            'attribute' 	=> $this->request->getPost('attribute'),
			'op' 	        => $this->request->getPost('op'),
			'value' 	    => $this->request->getPost('value')

		];

		if (! $groups->save($group)) {
			return redirect()->route('groups')->withInput()->with('errors', $groups->errors());
        }

        return redirect()->route('groups')->with('success', lang('Auth.updateSuccess'));
	}



    public function delete($id)
	{
		// check current password
		$groups = new GroupModel();
		
		$user = $groups->delete($id);


		// delete account from DB
		$groups->delete($id);


		// redirect to register with success message
		return redirect()->route('register')->with('success', lang('Auth.accountDeleted'));
	}

    public function create()
	{
		helper('text');

		$groups = new GroupModel();

		$getRule = $groups->getRule('cadastro');
		$groups->setValidationRules($getRule);
		

        $group = [
            'groupname'          	=> $this->request->getPost('groupname'),
            'attribute'          	=> $this->request->getPost('attribute'),
            'op'          	        => $this->request->getPost('op'),
            'value'         	    => $this->request->getPost('value')			
        ];

    if (! $groups->save($group) )  {
	    return redirect()->route('groups');
    }

    return redirect()->route('groups')->with('success', 'ok! Tudo certo mano!');
	}

}