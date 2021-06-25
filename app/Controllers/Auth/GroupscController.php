<?php
namespace App\Controllers\Auth;


use CodeIgniter\Controller;
use Config\Services;
use App\Models\GroupcModel;

class GroupscController extends Controller
{

	protected $session;
	protected $config;

    //--------------------------------------------------------------------

	public function __construct()
	{
		$this->session = Services::session();

	}

        
	public function Groupsc()
	{

		$groupsc= new GroupcModel();
		$allgroups = $groupsc->findall(); 
		$totalgroups = $groupsc->countAll(); 

		if (! $this->session->isLoggedIn) {
			return redirect()->route('public/login');
		}

		return view('auth/groupsc', [
			'userData' => $this->session->userData,
			'data' => $allgroups,
			'totalgroups' => $totalgroups,
		]);
	}

    public function edit()
	{

		// check if user is signed-in if not redirect to login page
		if (! $this->session->isLoggedIn) {
			return redirect()->route('login');
		}

		// get the user id
		$id = $this->request->uri->getSegment(3);

		// load user model
        $groupsc = new GroupcModel();

		// get user data using the id
		$groupc = $groupsc->where('id', $id)->first(); 


		//echo '<pre>';
		//print_r($userinfo); exit;

		// load the view with session data
		return view('auth/edits/edit-groupc', [
				'userData' => $this->session->userData, 
				'data' => $groupc
			]);
	}

	public function update()
	{
		// update user, validation happens in model
		$groupsc = new GroupcModel();
		$getRule = $groupsc->getRule('cadastro');
		$groupsc->setValidationRules($getRule);

		$groupc = [
			'id'  	        => $this->session->get('id'),
			'groupname' 	=> $this->request->getPost('groupname'),
            'attribute' 	=> $this->request->getPost('attribute'),
			'op' 	        => $this->request->getPost('op'),
			'value' 	    => $this->request->getPost('value')

		];

		if (! $groupsc->save($groupc)) {
			return redirect()->route('groupsc')->withInput()->with('errors', $groupsc->errors());
        }
        return redirect()->route('groupsc')->with('success', lang('Auth.updateSuccess'));
	}



    public function delete($id)
	{
		// check current password
		$groupsc = new GroupcModel();
		
		$user = $groupsc->delete($id);


		// delete account from DB
		$groupsc->delete($id);


		// redirect to register with success message
		return redirect()->route('groupsc')->with('success', lang('Auth.accountDeleted'));
	}

    public function create()
	{
		helper('text');

		$groupsc = new GroupcModel();

		$getRule = $groupsc->getRule('cadastro');
		$groupsc->setValidationRules($getRule);
		

        $group = [
            'groupname'          	=> $this->request->getPost('groupname'),
            'attribute'          	=> $this->request->getPost('attribute'),
            'op'          	        => $this->request->getPost('op'),
            'value'         	    => $this->request->getPost('value')			
        ];

    if (! $groupsc->save($group) )  {
	    return redirect()->route('groups');
    }

    return redirect()->route('groupsc')->with('success', 'ok! Tudo certo mano!');
	}

}