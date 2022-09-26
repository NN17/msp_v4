<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Main_model extends CI_Model{

		function __construct()
	    {
	        // Call the Model constructor
	        parent::__construct();
	        date_default_timezone_set('Asia/Rangoon');

	        $this->form_validation->set_message ('required','*');
	        $this->form_validation->set_message ('numeric','*');
	        $this->form_validation->set_message ('integer','*');
	        $this->form_validation->set_message ('max_length','*');
	        $this->form_validation->set_message ('matches','*');
	        $this->form_validation->set_message ('select_validate','*');
	        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');


	    // *************** Translate Eng-Num to Mya3-Num *******************

	        function num_translate($value)
	        {
	        	$input = $value;
	        	$mya = array('၀','၁','၂','၃','၄','၅','၆','၇','၈','၉');
	        	$eng = array('0','1','2','3','4','5','6','7','8','9');
	        	return str_replace($eng,$mya,$input);
	        }

	    // ****************** Name Of The Months (Eg- 1 is to January ..) *****************

	        function name_of_month($value)
	        {
	        	switch ($value)
	        	{
	        		case 1:
	        			return 'ဇန်နဝါရီ';
	        			break;
	        		case 2:
	        			return 'ဖေဖေါ်ဝါရီ';
	        			break;
	        		case 3:
	        			return 'မတ်';
	        			break;
	        		case 4:
	        			return 'ဧပရယ်';
	        			break;
	        		case 5:
	        			return 'မေ';
	        			break;
	        		case 6:
	        			return 'ဇွန်';
	        			break;
	        		case 7:
	        			return 'ဇူလိုင်';
	        			break;
	        		case 8:
	        			return 'သြဂုတ်';
	        			break;
	        		case 9:
	        			return 'စက်တင်ဘာ';
	        			break;
	        		case 10:
	        			return 'အောက်တိုဘာ';
	        			break;
	        		case 11:
	        			return 'နိုဝင်ဘာ';
	        			break;
	        		default:
	        			return 'ဒီဇင်ဘာ';
	        			break;
	        	}

	        	
	        }

	        function input($type, $machine, $required){
	        	if ($required == 1){
	        		$attr = 'required="required"';
	        	}
	        		else{
	        			$attr = '';
	        		}

	        	switch($type){
	        		case 'title':
	        			return '<input type="text" name="'.$machine.'" class="form-control" '.$attr.' />';
	        			break;
	        		case 'summary':
	        			return '<textarea name="'.$machine.'" class="form-control" '.$attr.'></textarea>';
	        			break;
	        	}
	        	
	        }

	        function editInput($type, $machine, $value, $required){
	        	if ($required == 1){
	        		$attr = 'required="required"';
	        	}
	        		else{
	        			$attr = '';
	        		}

	        	switch($type){
	        		case 'title':
	        			return '<input type="text" name="'.$machine.'" value="'.$value.'" class="form-control" '.$attr.' />';
	        			break;
	        		case 'summary':
	        			return '<textarea name="'.$machine.'" class="form-control" '.$attr.'>'.$value.'</textarea>';
	        			break;
	        	}
	        	
	        }

	        // layout Values

	        function layout(){
	        	$layout = array(
	        		'logo' => 'logo',
	        		'slogam' => 'slogam',
	        		'nav' => 'nav',
	        		'beforeContent' => 'before_content',
	        		'beforeContent2' => 'before_content_2',
	        		'beforeContent3' => 'before_content_3',
	        		'beforeContent4' => 'before_content_4',
	        		'beforeContent5' => 'before_content_5',
	        		'beforeContent6' => 'before_content_6',
	        		'beforeContent7' => 'before_content_7',
	        		'sidebar_left' => 'sidebar_left',
	        		'content' => 'content',
	        		'sidebar_right' => 'sidebar_right',
	        		'after_content1' => 'after_content_1',
	        		'after_content2' => 'after_content_2',
	        		'after_content3' => 'after_content_3',
	        		'after_content4' => 'after_content_4',
	        		'after_content5' => 'after_content_5',
	        		'after_content6' => 'after_content_6',
	        		'footer_first_left' => 'footer_first_left',
	        		'footer_first_center' => 'footer_first_center',
	        		'footer_first_right' => 'footer_first_right',
	        		'footer_second' => 'footer_second'
	        		);
	        	return $layout;
	        }

	        // content items

	        function input_items(){
	        	$items = array(
	        		'title' => 'Title',
	        		'summary' => 'Summary',
	        		'body' => 'Body',
	        		'upload' => 'File Upload',
	        		'download' => 'File Download',
	        		);

	        	return $items;
	        }

	        // User Levels

	        function userLevel($input){
	        	switch($input){
	        		case 1:
		        		return 'System Administrator';
		        		break;
		        	case 2: 
		        		return 'Admin';
		        		break;
		        	case 3: 
		        		return 'Moderator';
		        		break;
		        	default:
		        		return 'User';
		        		break;
	        	}
	        }

	        // Carousel Type

	        function carouselType($input){
	        	switch($input){
	        		case 1:
	        			return 'bootstrap_carousel';
	        			break;
	        		case 2:
	        			return 'devrama_carousel';
	        			break;
	        		case 3:
	        			return 'owl_carousel';
	        			break;
	        		default:
	        			return 'no_carousel';
	        			break;
	        	}
	        }


	}        

	// ------------------------- END OF MODEL CONSTRUCTOR -------------------------

	

	// ************** Counting Numbers of Rows Function ****************

	    function count_table_row($tablename)
	    {
			$count = $this->db->count_all($tablename);
			$id = $count+1;
			return $id;
	 	}

	// **************** Validate Login Function ***********************

	    function loginValidate()
		{
			$this->form_validation->set_rules('username','','required');
			$this->form_validation->set_rules('loginPassword','','required');

			if ($this->form_validation->run()==FALSE)
			{
				return false;
			}
			else
			{
				return true;
			}
		}

	


// **************** Login State Function ****************

		function loginState($name,$password)
		{
			
			$query = $this->db->query("SELECT * FROM users_tbl WHERE activate = 1")->result_array();
			if (!$query) {
				die ('Error:'.mysql_error());
				
			}
				else {
					// $result = 'false';
					foreach ($query as $row){
						if ($row['userName'] == $name){
							if ($row['password'] == md5($password)){
								$this->session->set_userdata('loginState',true);
								$this->session->set_userdata('name',$name);
								$this->session->set_userdata('Id',$row['Id']);
								$this->session->set_userdata('level',$row['userLevel']);
								$result = true;
								break;
							}
								else {
									$result = false;
								}
						}
							else {
								$result = false;
							}
							
					}

					if($result == true){
						return true;
					}
						else{
							return false;
						}
				} 
				// end of (!$query) condition
		}



	// ************** Max Id Function ****************

		function max_id($tablename)
		{
			$this->db->select_max('Id');
			$query = $this->db->get($tablename)->row_array();
			return ($query['Id']);
		}

		function max_sorting($tablename, $menuId){
			$this->db->where('menuId',$menuId);
			$this->db->select_max('sort');
			return ($query['sort']);
		}

		function get_limit_min_id($tablename,$var1,$var2){
			$this->db->where($var1,$var2);
			$this->db->select_min('Id');
			$query = $this->db->get($tablename)->row_array();
			return $query['Id'];
		}


		//*************** Validate Department Create Form Function *****************

		function validate_depForm()
		{
			$this->form_validation->set_rules('dep_name','','required');
			$this->form_validation->set_rules('dep_parent','','required');
			$this->form_validation->set_rules('dep_sort','','required|integer|max_length[6]');
			if ($this->form_validation->run()==FALSE)
			{
				return false;
			}
			else
			{
				return true;
			}
		}


		// ****************** Select Data Functions ********************

		function get_data($tablename)
		{
			$query = $this->db->get($tablename);
			return $query->result_array();
		}

		function get_negative_data($tablename,$var1,$var2)
		{
			$this->db->where_not_in($var1,$var2);
			$query = $this->db->get($tablename);
			return $query;
		}

		function get_data_asc($tablename,$type)
		{
			$this->db->order_by($type,'asc');
			$query = $this->db->get($tablename);
			return $query->result_array();
		}

		function get_data_desc($tablename,$type)
		{
			$this->db->order_by($type,'desc');
			$query = $this->db->get($tablename);
			return $query->result_array();
		}

		function get_limit_data($tablename,$var1,$var2)
		{
			$this->db->where($var1,$var2);
			$query = $this->db->get($tablename);
			return $query;
		}

		function get_limit_data_desc($tablename,$var1,$var2,$field)
		{
			$this->db->where($var1,$var2);
			$this->db->order_by($field,'desc');
			$query = $this->db->get($tablename);
			return $query;
		}

		function get_limit_data_pagination($table,$var1,$var2,$field,$start,$limit){
			$this->db->where($var1,$var2);
			$this->db->order_by($field,'desc');
			$this->db->limit($limit,$start);
			$query = $this->db->get($table);
			return $query;
		}

		function get_limit_datas_pagination($table,$var1,$var2,$var3,$var4,$field,$start,$limit){
			$this->db->where($var1,$var2);
			$this->db->where($var3,$var4);
			$this->db->order_by($field,'asc');
			$this->db->limit($limit,$start);
			$query = $this->db->get($table);
			return $query;
		}

		function get_data_pagination($table,$field,$start,$limit){
			$this->db->order_by($field,'desc');
			$this->db->limit($limit,$start);
			$query = $this->db->get($table);
			return $query;
		}

		function get_data_pagination_asc($table,$field,$start,$limit){
			$this->db->order_by($field,'asc');
			$this->db->limit($limit,$start);
			$query = $this->db->get($table);
			return $query;
		}

		// *********** Get datas with two conditions *************

		function get_limit_datas($tablename,$var1,$var2,$var3,$var4,$field = 'Id',$type ='DESC')
		{
			$this->db->where($var1,$var2);
			$this->db->where($var3,$var4);
			$this->db->order_by($field,$type);
			$query = $this->db->get($tablename);
			return $query;
		}

		function get_limit_negative_datas($tablename,$var1,$var2,$var3,$var4)
		{
			$this->db->where($var1,$var2);
			$this->db->where_not_in($var3,$var4);
			$query = $this->db->get($tablename);
			return $query;
		}

		function get_multi_limit_data($tablename,$var1,$var2,$var3,$var4)
		{
			$this->db->where($var1,$var2);
			$this->db->where($var3,$var4);
			$query = $this->db->get($tablename);
			return $query;
		}

		function get_inbox_data()
		{
			$this->db->where('Owner_Id',$this->session->userdata('Id'));
			$this->db->where_not_in('Sender_Id','');
			$this->db->order_by('Transfer_Date','desc');
			$query = $this->db->get('mail_tbl');
			return $query;
		}

		function get_sub_menus($menuId, $linkId){
			$query = $this->db->query("SELECT * FROM link_structure_tbl WHERE type = 'Sub' AND menuId = $menuId AND mainMenu = $linkId ")->result_array();
			return $query;
		}

		// ********** Getting Products for Home Page ***********

		function get_product(){
			$query = $this->db->query("SELECT * FROM content_tbl WHERE frontPage = 1 ORDER BY createdDate LIMIT 3")->result_array();
			return $query;
		}
		
		function get_latestProject(){
		    $query = $this->db->query("SELECT * FROM content_tbl WHERE frontPage = 1 ORDER BY createdDate")->result_array();
			return $query;
		}

		function get_project(){
			$query = $this->db->query("SELECT * FROM content_tbl WHERE link >= 20 AND link <= 31 AND frontPage = 1 ORDER BY createdDate LIMIT 4")->result_array();
			return $query;
		}

		function validate_quickStartForm()
		{
			$this->form_validation->set_rules('name','','required');
			$this->form_validation->set_rules('psw','','required');
			$this->form_validation->set_rules('repsw','','required|matches[psw]');
			$this->form_validation->set_rules('email','','required');
			if ($this->form_validation->run() == FALSE)
			{
				return false;
			}
				else 
				{
					return true;
				}
		}

		function get_num_row($table){
			$count = $this->db->count_all_results($table);
			return $count;
		}

		function get_content_row($id){
			$this->db->where('link',$id);
			$this->db->where('published',true);
			$count = $this->db->count_all_results('content_tbl');
			return $count;
		}

		function get_block_content_data($blockId, $contentType) {
			$this->db->where('blockId', $blockId);
			$this->db->where('contentTypeId', $contentType);
			$this->db->where('published', true);
			$this->db->order_by('publishedDate', 'ASC');
			$query = $this->db->get('content_tbl');
			return $query;
		}

		// ****************** Form Validation Require (3 Fields) ********************

		function validate_required($var1,$var2,$var3)
		{
			$this->form_validation->set_rules($var1,'','required');
			$this->form_validation->set_rules($var2,'','required');
			$this->form_validation->set_rules($var3,'','required');
			if ($this->form_validation->run() == FALSE)
			{
				return false;
			}
				else
				{
					return true;
				}
		}

	

	// ********************** validate_userSetting **************************

		function validate_userSetting()
		{
			$this->form_validation->set_rules('password','','required');
			$this->form_validation->set_rules('rePassword','','required|matches[password]');
			if ($this->form_validation->run()== FALSE)
			{
				return false;
			}
				else
				{
					return true;
				}
		}

	

	// ------------------------ Upload Image Function --------------------------

		function upload_img($file,$path)
		{
			$config['upload_path'] = './'.$path.'/';
			$config['allowed_types'] = 'gif|jpg|jpeg|png';
			$config['max_size'] = '0';
			$this->load->library('upload', $config);
			
			if ($this->upload->do_upload($file))
			{
				$file_name = $this->upload->data('file_name');
				return $path.'/'.$file_name;

			}
				else
				{
					return false;
				}

		}

		function upload_file_img($file,$path)
		{
			$config['upload_path'] = './'.$path.'/';
			$config['allowed_types'] = 'gif|jpg|jpeg|png';
			$config['max_size'] = '0';
			$this->load->library('upload', $config);
			
			if ($this->upload->do_upload($file))
			{
				$file_name = $this->upload->data('file_name');
				return $file_name;

			}
				else
				{
					return $this->upload->display_errors();
				}

		}

		// Return Username

		function userName($input){
			$this->db->where('Id',$input);
			$query = $this->db->get('users_tbl')->row_array();
			return $query['name'];
		}

		function office($input){
			$this->db->where('Id',$input);
			$query = $this->db->get('office_tbl')->row_array();
			return $query['name'];
		}

		function department($input){
			$this->db->where('Id',$input);
			$query = $this->db->get('department_tbl')->row_array();
			return $query['name'];
		}

		function get_last_update($id,$func){
			$this->db->where('updatedId',$id);
			$this->db->where('function',$func);
			$this->db->select_max('updatedDate');
			$max_date = $this->db->get('history_tbl');
			return $max_date->row_array();
		}

		function get_history_data($id,$func){
			$this->db->where('updatedId',$id);
			$this->db->where('function',$func);
			$this->db->order_by('updatedDate','desc');
			$query = $this->db->get('history_tbl');
			return $query;
		}
		
		// ************** Extra functions **************

		function check_block($pageId, $layoutId){
			$query = $this->db->query("SELECT * FROM blocks_tbl WHERE (relatedLink = 0 OR relatedLink = $pageId) AND layout = $layoutId");
			return $query->row_array();
		}

		function link($input){
			if($input == 0){
				return 'All Pages';
			}
				else{
					$this->db->where('Id',$input);
					$query = $this->db->get('link_structure_tbl')->row_array();
					return $query['name'];
				}
		}

		function layout($input){
			$this->db->where('Id',$input);
			$query = $this->db->get('layout_tbl')->row_array();
			return $query['name'];
		}

		function checkContentItem($id, $item) {
			$this->db->where('contentTypeId', $id);
			$this->db->where('type', $item);
			$query = $this->db->get('content_items_tbl')->row();
			if(!empty($query->Id)) {
				return true;
			}
				else{
					return false;
				}

		}

		function get_main_links($menuId) {
			$this->db->where('menuId', $menuId);
			$this->db->where('type', 'Main');
			$this->db->where('showOnNav', true);
			$this->db->order_by('sort', 'ASC');
			$query = $this->db->get('link_structure_tbl');
			return $query;
		}

		function get_sub_links($mainMenuId) {
			$this->db->where('mainMenu', $mainMenuId);
			$this->db->where('type', 'Sub');
			$this->db->where('showOnNav', true);
			$this->db->order_by('sort', 'ASC');
			$query = $this->db->get('link_structure_tbl');
			return $query;
		}

		function get_front_page_product() {
			$data = $this->db->query("SELECT * FROM content_tbl
					WHERE frontPage = true
					AND published = true
					AND (link = 11 
						OR link = 12 
						OR link = 13
						OR link = 14
						OR link = 15
						OR link = 16
						OR link = 17
						OR link = 18
						OR link = 19
						OR link = 20
						OR link = 21
						OR link = 22)
					");

			return $data->result_array();
		}

	}