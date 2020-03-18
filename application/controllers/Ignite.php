<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ignite extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	// --------------- Home page -------------------

	public function index()
	{
		$this->load->dbforge();

		// --------------- Create users_tbl -------------------

		$fields = array(
			'Id' => array(
				'type' => 'INT',
				'constraint' => 5,
				'auto_increment' => TRUE
				),
			'userName' => array(
				'type' => 'VARCHAR',
				'constraint' => 55,
				),
			'password' => array(
				'type' => 'VARCHAR',
				'constraint' => 100
				),
			'name' => array(
				'type' => 'VARCHAR',
				'constraint' => 100
				),
			'userLevel' => array(
				'type' => 'INT',
				'constraint' => 5
				),
			'activate' => array(
				'type' => 'INT',
				'constraint' => 5
				),
			);
		$this->dbforge->add_key('Id',TRUE);
		$this->dbforge->add_field($fields);
		$this->dbforge->create_table('users_tbl',TRUE);

		// ----------------------------------------------

		$num_row = $this->db->count_all_results('users_tbl');
		if($num_row < 1){
			$insert = array(
				'userName' => 'system',
				'password' => md5(123456),
				'name' => 'System Administrator',
				'userLevel' => 1,
				'activate' => 1
				);
			$this->db->insert('users_tbl',$insert);
		}

		// --------------- Create blocks_tbl --------------

		$fields_block = array(
			'Id' => array(
				'type' => 'INT',
				'constraint' => 5,
				'auto_increment' => TRUE
				),
			'name' => array(
				'type' => 'VARCHAR',
				'constraint' => 100,
				),
			'note' => array(
				'type' => 'VARCHAR',
				'constraint' => 200
				),
			'file' => array(
				'type' => 'VARCHAR',
				'constraint' => 100
				),
			'type' => array(
				'type' => 'VARCHAR',
				'constraint' => 22
				),
			'relatedId' => array(
				'type' => 'INT',
				'constraint' => 5
				),
			'relatedLink' => array(
				'type' => 'INT',
				'constraint' => 5
				),
			'layout' => array(
				'type' => 'INT',
				'constraint' => 55
				),
			);

		$this->dbforge->add_key('Id',TRUE);
		$this->dbforge->add_field($fields_block);
		$this->dbforge->create_table('blocks_tbl',TRUE);

		// ----------------------------------------------

		if(!file_exists('./application/views/blocks/main_menu.php')){
			$code = read_file('./application/views/backend/menu.php');
			$code = str_replace('variable','nav_relatedId',$code);
			write_file('./application/views/blocks/main_menu.php',$code,'w');
		}

		$block_row = $this->db->count_all_results('blocks_tbl');
		if($block_row < 1){
			$insert_block = array(
				'name' => 'Main menu',
				'note' => 'System main menu',
				'file' => 'main_menu',
				'type' => 'menu',
				'relatedId' => 1,
				'relatedLink' => 0,
				'layout' => 3
				);
			$this->db->insert('blocks_tbl',$insert_block);
		}

		// --------------- Create carousel_tbl --------------

		$fields_carousel = array(
			'Id' => array(
				'type' => 'INT',
				'constraint' => 5,
				'auto_increment' => TRUE
				),
			'name' => array(
				'type' => 'VARCHAR',
				'constraint' => 100
				),
			'note' => array(
				'type' => 'VARCHAR',
				'constraint' => 200
				),
			'type' => array(
				'type' => 'INT',
				'constraint' => 5
				),
			'blockId' => array(
				'type' => 'INT',
				'constraint' => 5
				),
			);

		$this->dbforge->add_key('Id',TRUE);
		$this->dbforge->add_field($fields_carousel);
		$this->dbforge->create_table('carousel_tbl',TRUE);

		// ----------------------------------------------

		// --------------- Create carousel_img_tbl --------------

		$fields_carousel_img = array(
			'Id' => array(
				'type' => 'INT',
				'constraint' => 5,
				'auto_increment' => TRUE
				),
			'path' => array(
				'type' => 'VARCHAR',
				'constraint' => 200,
				),
			'carouselId' => array(
				'type' => 'INT',
				'constraint' => 5
				),
			);

		$this->dbforge->add_key('Id',TRUE);
		$this->dbforge->add_field($fields_carousel_img);
		$this->dbforge->create_table('carousel_img_tbl',TRUE);

		// ----------------------------------------------

		// --------------- Create Content_tbl --------------

		$fields_content = array(
			'Id' => array(
				'type' => 'INT',
				'constraint' => 5,
				'auto_increment' => TRUE
				),
			'title' => array(
				'type' => 'VARCHAR',
				'constraint' => 100,
				),
			'summary' => array(
				'type' => 'VARCHAR',
				'constraint' => 200
				),
			'text' => array(
				'type' => 'TEXT'
				),
			'link' => array(
				'type' => 'INT',
				'constraint' => 5
				),
			'createdUserId' => array(
				'type' => 'INT',
				'constraint' => 5
				),
			'createdDate' => array(
				'type' => 'INT',
				'constraint' => 22
				),
			'publishedDate' => array(
				'type' => 'INT',
				'constraint' => 22
				),
			'published' => array(
				'type' => 'INT',
				'constraint' => 5
				),
			'frontPage' => array(
				'type' => 'INT',
				'constraint' => 5
				),
			'showDate' => array(
				'type' => 'INT',
				'constraint' => 5
				),
			'blockId' => array(
				'type' => 'INT',
				'constraint' => 5
				),
			'filterId' => array(
				'type' => 'INT',
				'constraint' => 5
				),
			'contentTypeId' => array(
				'type' => 'INT',
				'constraint' => 5
				)
			);

		$this->dbforge->add_key('Id',TRUE);
		$this->dbforge->add_field($fields_content);
		$this->dbforge->create_table('content_tbl',TRUE);

		// ----------------------------------------------

		// --------------- Create content_type_tbl --------------

		$fields_content_type = array(
			'Id' => array(
				'type' => 'INT',
				'constraint' => 5,
				'auto_increment' => TRUE
				),
			'name' => array(
				'type' => 'VARCHAR',
				'constraint' => 200,
				),
			'note' => array(
				'type' => 'VARCHAR',
				'constraint' => 200,
				),
			'relatedLink' => array(
				'type' => 'INT',
				'constraint' => 5
				),
			'filterId' => array(
				'type' => 'INT',
				'constraint' => 5
				),
			);

		$this->dbforge->add_key('Id',TRUE);
		$this->dbforge->add_field($fields_content_type);
		$this->dbforge->create_table('content_type_tbl',TRUE);

		// ----------------------------------------------

		$contentType_row = $this->db->count_all_results('content_type_tbl');
		if($contentType_row < 1){
			$insert_basicPage = array(
				'name' => 'Add Content',
				'note' => 'To Create Content',
				'relatedLink' => 0,
				'filterId' => 0
				);
			$this->db->insert('content_type_tbl',$insert_basicPage);
		}

		// --------------- Create menu_tbl --------------

		$fields_menu = array(
			'Id' => array(
				'type' => 'INT',
				'constraint' => 5,
				'auto_increment' => TRUE
				),
			'name' => array(
				'type' => 'VARCHAR',
				'constraint' => 200,
				),
			'note' => array(
				'type' => 'VARCHAR',
				'constraint' => 200
				),
			'blockId' => array(
				'type' => 'INT',
				'constraint' => 5
				),
			);

		$this->dbforge->add_key('Id',TRUE);
		$this->dbforge->add_field($fields_menu);
		$this->dbforge->create_table('menu_tbl',TRUE);

		// ----------------------------------------------

		$menu_row = $this->db->count_all_results('menu_tbl');
		if($menu_row < 1){
			$insert_menu = array(
				'name' => 'Main Menu',
				'note' => 'System main menu',
				'blockId' => 1
				);
			$this->db->insert('menu_tbl',$insert_menu);
		}

		// --------------- Create link_structure_tbl --------------

		$fields_link_structure = array(
			'Id' => array(
				'type' => 'INT',
				'constraint' => 5,
				'auto_increment' => TRUE
				),
			'sort' => array(
				'type' => 'INT',
				'constraint' => 5
				),
			'name' => array(
				'type' => 'VARCHAR',
				'constraint' => 200,
				),
			'type' => array(
				'type' => 'VARCHAR',
				'constraint' => 200,
				),
			'menuId' => array(
				'type' => 'INT',
				'constraint' => 5
				),
			'mainMenu' => array(
				'type' => 'INT',
				'constraint' => 5
				),
			'note' => array(
				'type' => 'VARCHAR',
				'constraint' => 200
				),
			'img_path' => array(
				'type' => 'VARCHAR',
				'constraint' => 200,
				),
			);

		$this->dbforge->add_key('Id',TRUE);
		$this->dbforge->add_field($fields_link_structure);
		$this->dbforge->create_table('link_structure_tbl',TRUE);

		// ----------------------------------------------

		$link_row = $this->db->count_all_results('link_structure_tbl');
		if($link_row < 1){
			$insert_link = array(
				'sort' => 1,
				'name' => 'Home',
				'type' => 'Main',
				'menuId' => 1,
				'note' => 'system created',
				'img_path' => 'null'
				);
			$this->db->insert('link_structure_tbl',$insert_link);
		}

		// --------------- Create slogam_tbl --------------

		$fields_slogam = array(
			'Id' => array(
				'type' => 'INT',
				'constraint' => 5,
				'auto_increment' => TRUE
				),
			'logo' => array(
				'type' => 'VARCHAR',
				'constraint' => 200,
				),
			'slogam' => array(
				'type' => 'VARCHAR',
				'constraint' => 200
				),
			);

		$this->dbforge->add_key('Id',TRUE);
		$this->dbforge->add_field($fields_slogam);
		$this->dbforge->create_table('slogam_tbl',TRUE);

		// ----------------------------------------------

		$slogam_row = $this->db->count_all_results('slogam_tbl');
		if($slogam_row < 1){
			$insert_slogam = array(
				'logo' => 'asset/system_img/logo.png',
				'slogam' => 'Ignite Source'
				);
			$this->db->insert('slogam_tbl',$insert_slogam);
		}

		// --------------- Create upload_img_tbl --------------

		$fields_upload = array(
			'Id' => array(
				'type' => 'INT',
				'constraint' => 5,
				'auto_increment' => TRUE
				),
			'name' => array(
				'type' => 'VARCHAR',
				'constraint' => 200,
				),
			'path' => array(
				'type' => 'VARCHAR',
				'constraint' => 200
				),
			);

		$this->dbforge->add_key('Id',TRUE);
		$this->dbforge->add_field($fields_upload);
		$this->dbforge->create_table('upload_img_tbl',TRUE);

		// ----------------------------------------------

		// --------------- Create layout_tbl --------------

		$fields_layout = array(
			'Id' => array(
				'type' => 'INT',
				'constraint' => 5,
				'auto_increment' => TRUE
				),
			'name' => array(
				'type' => 'VARCHAR',
				'constraint' => 200,
				),
			);

		$this->dbforge->add_key('Id',TRUE);
		$this->dbforge->add_field($fields_layout);
		$this->dbforge->create_table('layout_tbl',TRUE);

		// ----------------------------------------------

		// ******** Inserting Layout Data **********

		$menu_row = $this->db->count_all_results('layout_tbl');
		if($menu_row < 1){
			$layouts = layout();
			foreach($layouts as $layout){
				$insert_layout = array(
					'name' => $layout
					);
				$this->db->insert('layout_tbl',$insert_layout);
			}
		}

		// ----------------------------------------------

		// --------------- content_items_tbl --------------

		$fields_items = array(
			'Id' => array(
				'type' => 'INT',
				'constraint' => 5,
				'auto_increment' => TRUE
				),
			'name' => array(
				'type' => 'VARCHAR',
				'constraint' => 200
				),
			'machine' => array(
				'type' => 'VARCHAR',
				'constraint' => 20
				),
			'note' => array(
				'type' => 'VARCHAR',
				'constraint' => 200
				),
			'type' => array(
				'type' => 'VARCHAR',
				'constraint' => 50
				),
			'required' => array(
				'type' => 'INT',
				'constraint' => 5
				),
			'contentTypeId' => array(
				'type' => 'INT',
				'constraint' => 5
				),
			);

		$this->dbforge->add_key('Id',TRUE);
		$this->dbforge->add_field($fields_items);
		$this->dbforge->create_table('content_items_tbl',TRUE);

		// ----------------------------------------------

		// ******** Inserting Layout Data **********

		$item_row = $this->db->count_all_results('content_items_tbl');
		if($item_row < 1){
			$insert_item1 = array(
				'name' => 'Title',
				'machine' => 'title',
				'note' => 'Input for Title',
				'type' => 'title',
				'required' => 1,
				'contentTypeId' => 1
				);
			$this->db->insert('content_items_tbl',$insert_item1);

			$insert_item2 = array(
				'name' => 'Summary',
				'machine' => 'summary',
				'note' => 'Input for Summary',
				'type' => 'summary',
				'required' => 0,
				'contentTypeId' => 1
				);
			$this->db->insert('content_items_tbl',$insert_item2);

			$insert_item3 = array(
				'name' => 'Body',
				'machine' => 'body',
				'note' => 'Input for Body Text',
				'type' => 'body',
				'required' => 1,
				'contentTypeId' => 1
				);
			$this->db->insert('content_items_tbl',$insert_item3);
		}

		// ----------------------------------------------

		// --------------- Create items_type_tbl --------------

		$fields_item = array(
			'Id' => array(
				'type' => 'INT',
				'constraint' => 5,
				'auto_increment' => TRUE
				),
			'name' => array(
				'type' => 'VARCHAR',
				'constraint' => 200,
				),
			'machine' => array(
				'type' => 'VARCHAR',
				'constraint' => 200
				),
			);

		$this->dbforge->add_key('Id',TRUE);
		$this->dbforge->add_field($fields_item);
		$this->dbforge->create_table('items_type_tbl',TRUE);

		// ----------------------------------------------

		// ******** Inserting Items Data **********

		$item_row = $this->db->count_all_results('items_type_tbl');
		if($item_row < 1){
			$insert_item1 = array(
				'name' => 'Title',
				'machine' => 'title'
				);
			$this->db->insert('items_type_tbl',$insert_item1);
			$insert_item2 = array(
				'name' => 'Summary',
				'machine' => 'summary'
				);
			$this->db->insert('items_type_tbl',$insert_item2);
			$insert_item3 = array(
				'name' => 'Body Text',
				'machine' => 'body'
				);
			$this->db->insert('items_type_tbl',$insert_item3);
			$insert_item4 = array(
				'name' => 'Download',
				'machine' => 'download'
				);
			$this->db->insert('items_type_tbl',$insert_item4);
		}

		// ----------------------------------------------

		// *************** End Of Initializing *****************

		
		$layouts = $this->main_model->get_data('layout_tbl');
			foreach ($layouts as $layout){
				$block = $this->main_model->check_block(1, $layout['Id']);
				if(!empty($block)){
					$data[$layout['name'].'_relatedId'] = $block['relatedId'];
					$data[$layout['name']] = 'blocks/'.$block['file'];
				}
				
			}
		$data['page'] = 1;
		$data['content'] = 'userfiles/home';
		$this->load->view('template',$data);


	}

	// --------------- End of Index ----------------

	// --------------- Layout ----------------

	public function layout(){
		$data['menu'] = 'backend/menu';
		$data['content'] = 'backend/layout';
		$this->load->view('template',$data);
	}

	// ---------------- Navigation & Link Structure -----------------

	public function navigation(){
		$data['menus'] = $this->main_model->get_data('menu_tbl');
		$data['menu'] = 'backend/menu';
		$data['content'] = 'backend/navigation';
		$this->load->view('template',$data);
	}

	// public function newMenu(){
	// 	$data['menu'] = 'backend/menu';
	// 	$data['content'] = 'backend/newMenu';
	// 	$this->load->view('template',$data);
	// }

	public function addMenu(){
		$name = $this->input->post('name');
		$note = $this->input->post('note');
		$blockId = $this->input->post('blockId');

		$insert = array(
			'name' => $name,
			'note' => $note,
			'blockId' => $blockId
			);
		$this->db->insert('menu_tbl',$insert);
		$id = $this->main_model->max_id('menu_tbl');

		$update = array('relatedId' => $id);
		$this->db->where('Id',$blockId);
		$this->db->update('blocks_tbl',$update);

		redirect('ignite/newLink/'.$id);
	}

	public function navEdit(){
		$id = $this->uri->segment(3);

		$data['menu'] = 'backend/menu';
		$data['content'] = 'backend/navEdit';
		$data['editData'] = $this->main_model->get_limit_data('menu_tbl','Id',$id)->row_array();
		$this->load->view('template',$data);
	}

	public function navUpdate(){
		$id = $this->uri->segment(3);

		$name = $this->input->post('name');
		$note = $this->input->post('note');
		$blockId = $this->input->post('blockId');

		$update = array(
			'name' => $name,
			'note' => $note,
			'blockId' => $blockId
			);
		$this->db->where('Id',$id);
		$this->db->update('menu_tbl',$update);
		redirect('ignite/navigation');
	}

	public function newLink(){
		$menuId = $this->uri->segment(3);
		$data['navigation'] = $this->main_model->get_limit_data('menu_tbl','Id',$menuId)->row_array();
		// $data['menu'] = 'backend/menu';
		$data['content'] = 'backend/newLink';
		$this->load->view('template',$data);
	}

	public function addLink(){
		$menuId = $this->uri->segment(3);

		$name = $this->input->post('name');
		$note = $this->input->post('note');
		$type = $this->input->post('menuType');
		$main = $this->input->post('mainMenu');
		if($main == ''){
			$main = 0;
		}
		$image = $this->main_model->upload_img('userfile','menu_img');
		if($image == false){
			$image = 'null';
		}

		$maxSorting = $this->main_model->max_id('link_structure_tbl',$menuId);

		$insert = array(
			'sort' => $maxSorting+1,
			'name' => $name,
			'note' => $note,
			'type' => $type,
			'menuId' => $menuId,
			'mainMenu' => $main,
			'img_path' => $image
			);
		$this->db->insert('link_structure_tbl',$insert);
		redirect('ignite/newLink/'.$menuId);
	}

	public function editLink(){
		$linkId = $this->uri->segment(3);

		$data['link'] = $this->main_model->get_limit_data('link_structure_tbl','Id',$linkId)->row_array();
		$data['content'] = 'backend/editLink';
		$this->load->view('template',$data);
	}

	public function updateLink(){
		$linkId = $this->uri->segment(3);

		$link = $this->main_model->get_limit_data('link_structure_tbl','Id',$linkId)->row_array();

		$name = $this->input->post('name');
		$note = $this->input->post('note');
		$menuType = $this->input->post('menuType');
		$mainMenu = $this->input->post('mainMenu');
		if($mainMenu == ''){
			$mainMenu = 0;
		}
		$image = $this->main_model->upload_img('userfile','menu_img');
		if($image == false){
			$image = 'null';
		}

		$update = array(
			'name' => $name,
			'note' => $note,
			'type' => $menuType,
			'mainMenu' => $mainMenu,
			'img_path' => $image
			);

		$this->db->where('Id',$linkId);
		$this->db->update('link_structure_tbl',$update);
		redirect('ignite/newLink/'.$link['menuId']);
	}

	public function changeLink(){
		$dragId = $this->uri->segment(3);
		$dropId = $this->uri->segment(4);
		$drag = $this->main_model->get_limit_data('link_structure_tbl','Id',$dragId)->row_array();
		$drop = $this->main_model->get_limit_data('link_structure_tbl','Id',$dropId)->row_array();
		$link = $this->main_model->get_limit_data('link_structure_tbl','Id',$dragId)->row_array();

		$updateDrag= array('sort'=>$drop['sort']);
		$this->db->where('Id',$dragId);
		$this->db->update('link_structure_tbl',$updateDrag);

		$updateDrop = array('sort' => $drag['sort']);
		$this->db->where('Id',$dropId);
		$this->db->update('link_structure_tbl',$updateDrop);
		$data['navigation'] = $this->main_model->get_limit_data('menu_tbl','Id',$link['menuId'])->row_array();
		$this->load->view('backend/linkStructure',$data);

	}

	// ---------------- Logo & Slogam -----------------

	public function slogam(){
		$data['menu'] = 'backend/menu';
		$data['content'] = 'backend/slogam';
		$this->load->view('template',$data);
	}

	public function addSlogam(){
		$logo = $this->main_model->upload_img('logo','system_img');
		if($logo == false){
			$logo = 'null';
		}
		$slogam = $this->input->post('slogam');
		if(empty($slogam)){
			$slogam = 'null';
		}

		$update = array(
			'logo' => $logo,
			'slogam' => $slogam
			);

		$this->db->update('slogam_tbl',$update);
		redirect('ignite/index');
	}

	// ------------ Block functions ----------------

	public function newBlock(){
		$data['menu'] = 'backend/menu';
		$data['content'] = 'backend/newBlock';
		$data['layouts'] = $this->main_model->get_data('layout_tbl');
		$this->load->view('template',$data);
	}

	public function checkBlockName(){
		$name = $this->uri->segment(3);
		if(file_exists('./application/views/blocks/'.$name.'.php')){
			echo '<i class="fa fa-warning text-warning"></i> Error: File name already exist.';
		}
	}

	public function addBlock(){
		$blockName = $this->input->post('blockName');
		$note = $this->input->post('note');
		$file = $this->input->post('fileName');
		$type = $this->input->post('type');
		$link = $this->input->post('link');
		$template = $this->input->post('template');

		$insert = array(
			'name' => $blockName,
			'note' => $note,
			'file' => $file,
			'type' => $type,
			'relatedLink' => $link,
			'layout' => $template
			);

		$this->db->insert('blocks_tbl',$insert);
		$id = $this->main_model->max_id('blocks_tbl');
		$layout = $this->main_model->get_limit_data('layout_tbl','Id',$template)->row_array();

		if($type == 'menu'){
			if(!file_exists('./application/views/blocks/'.$file.'.php')){
				$code = read_file('./application/views/backend/menu.php');
				$code = str_replace('variable',$layout['name'].'_relatedId',$code);
				write_file('./application/views/blocks/'.$file.'.php',$code,'w');
			}

			redirect('ignite/menuBlock/'.$id);
		}
			elseif($type == 'view'){
				if(!file_exists('./application/views/blocks/'.$file.'.php')){
					$code = read_file('./application/views/backend/view.php');
					$code = str_replace('variable',$layout['name'].'_relatedId',$code);
					write_file('./application/views/blocks/'.$file.'.php',$code,'w');
				}

				redirect('ignite/viewBlock/'.$id);

			}
				else{
					if(!file_exists('./application/views/blocks/'.$file.'.php')){
						$code = read_file('./application/views/backend/carousel.php');
						$code = str_replace('variable',$layout['name'].'_relatedId',$code);
						write_file('./application/views/blocks/'.$file.'.php',$code,'w');
					}

					redirect('ignite/carouselBlock/'.$id);
				}
	}

	// ********* Menu Block *********

	public function menuBlock(){
		$id = $this->uri->segment(3);

		$data['blockData'] = $this->main_model->get_limit_data('blocks_tbl','Id',$id)->row_array();
		// $data['menu'] = 'backend/menu';
		$data['content'] = 'backend/menuBlock';
		$this->load->view('template',$data);
	}

	// ********** View Block ***********

	public function viewBlock(){
		$id = $this->uri->segment(3);

		// loading Ckeditor ..
		$this->load->library('CKEditor');
		
		$this->ckeditor->basePath = base_url().'asset/ckeditor/';
		$this->ckeditor->config['toolbar'] =  'Full';
		$this->ckeditor->config['language'] = 'en';
		$this->ckeditor->config['font_style'] = 'myanmar';
		$this->ckeditor->config['width'] = '100%';
		$this->ckeditor->config['height'] = '300px';
		$this->ckeditor->config['filebrowserImageBrowseUrl'] = base_url().'ignite/imageBrowse';

		$data['blockData'] = $this->main_model->get_limit_data('blocks_tbl','Id',$id)->row_array();
		$data['menu'] = 'backend/menu';
		$data['content'] = 'backend/viewBlock';
		$this->load->view('template',$data);
	}

	public function addViewBlock(){
		$id = $this->uri->segment(3);

		$title = $this->input->post('title');
		$text = $this->input->post('text');
		$createdUser = $this->session->userdata('Id');
		$createdDate = getDate();
		$publishedDate = getDate();
		$published = true;
		$blockId = $id;

		$insert = array(
			'title' => $title,
			'text' => $text,
			'createdUserId' => $createdUser,
			'createdDate' => $createdDate[0],
			'publishedDate' => $publishedDate[0],
			'published' => $published,
			'blockId' => $blockId
			);

		$this->db->insert('content_tbl',$insert);
		$contentId = $this->main_model->max_id('content_tbl');

		$this->db->where('Id',$blockId);
		$updateBlock = array('relatedId' => $contentId);
		$this->db->update('blocks_tbl',$updateBlock);

		redirect('ignite/index');
	}

	// *********** Edit View Block ***********

	public function editViewContent(){
		$contentId = $this->uri->segment(3);

		// loading Ckeditor ..
		$this->load->library('CKEditor');
		
		$this->ckeditor->basePath = base_url().'asset/ckeditor/';
		$this->ckeditor->config['toolbar'] =  'Full';
		$this->ckeditor->config['language'] = 'en';
		$this->ckeditor->config['font_style'] = 'myanmar';
		$this->ckeditor->config['width'] = '100%';
		$this->ckeditor->config['height'] = '300px';
		$this->ckeditor->config['filebrowserImageBrowseUrl'] = base_url().'ignite/imageBrowse';

		$data['contentData'] = $this->main_model->get_limit_data('content_tbl','Id',$contentId)->row_array();

		$data['content'] = 'backend/editViewBlock';
		$this->load->view('template',$data);
	}

	public function updateViewBlock(){
		$contentId = $this->uri->segment(3);

		$title = $this->input->post('title');
		$text = $this->input->post('text');

		$update = array(
			'title' => $title,
			'text' => $text
			); 

		$this->db->where('Id',$contentId);
		$this->db->update('content_tbl',$update);
		redirect('ignite/index');
	}

	// ************ Carousel Block ************

	public function carouselBlock(){
		$id = $this->uri->segment(3);

		$data['blockData'] = $this->main_model->get_limit_data('blocks_tbl','Id',$id)->row_array();
		$data['menu'] = 'backend/menu';
		$data['content'] = 'backend/carouselBlock';
		$this->load->view('template',$data);
	}

	public function addCarousel(){
		$blockId = $this->uri->segment(3);

		$name = $this->input->post('name');
		$note = $this->input->post('note');
		$type = $this->input->post('type');

		$insert = array(
			'name' => $name,
			'note' => $note,
			'type' => $type,
			'blockId' => $blockId
			);
		$this->db->insert('carousel_tbl',$insert);
		$carouselId = $this->main_model->max_id('carousel_tbl');

		for($i=1; $i<=3; $i++){
			$carouselImg = array(
				'path' => 'system_img/img'.$i.'.jpg',
				'carouselId' => $carouselId
				);
			$this->db->insert('carousel_img_tbl',$carouselImg);
		}

		$update_block = array('relatedId' => $carouselId);
		$this->db->where('Id',$blockId);
		$this->db->update('blocks_tbl',$update_block);

		redirect('ignite/previewCarousel/'.$carouselId);
	}

	public function previewCarousel(){
		$data['carouselId'] = $this->uri->segment(3);

		$data['carousel'] = $this->main_model->get_limit_data('carousel_tbl','Id',$data['carouselId'])->row_array();
		$data['content'] = 'backend/carouselPreview';
		$this->load->view('template',$data);
	}

	public function blockList(){

		// ************** Pagination Start **************
		
		$row = $this->main_model->get_num_row('blocks_tbl');

		$this->load->library('pagination');

		$config['base_url'] = base_url().'ignite/blockList/';
		$config['total_rows'] = $row;
		$config['per_page'] = 20;
		$config['uri_segment'] = 3;

		$config['cur_tag_open'] = '<li class="active">';
		$config['cur_tag_close'] = '</li>';

		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';

		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';

		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';

		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';

		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';

		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';

		$this->pagination->initialize($config);

		$start = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		$data['blocks'] = $this->main_model->get_data_pagination('blocks_tbl','Id',$start,20)->result_array();
		$data['content'] = 'backend/blockList';
		$this->load->view('template',$data);
	}

	public function editBlock(){
		$blockId = $this->uri->segment(3);

		$data['block'] = $this->main_model->get_limit_data('blocks_tbl','Id',$blockId)->row_array();
		$data['layouts'] = $this->main_model->get_data('layout_tbl');
		$data['content'] = 'backend/editBlock';
		$this->load->view('template',$data);
	}

	public function updateBlock(){
		$blockId = $this->uri->segment(3);

		$note = $this->input->post('note');
		$file = $this->input->post('fileName');
		$type = $this->input->post('type');
		$link = $this->input->post('link');
		$template = $this->input->post('template');

		$update = array(
			'note' => $note,
			'type' => $type,
			'relatedLink' => $link,
			'layout' => $template
			);
		$this->db->where('Id',$blockId);
		$this->db->update('blocks_tbl',$update);

		$layout = $this->main_model->get_limit_data('layout_tbl','Id',$template)->row_array();
		if($type == 'menu'){
			if(file_exists('./application/views/blocks/'.$file.'.php')){
				$code = read_file('./application/views/backend/menu.php');
				$code = str_replace('variable',$layout['name'].'_relatedId',$code);
				write_file('./application/views/blocks/'.$file.'.php',$code,'w+');
			}
		}
			elseif($type == 'view'){
				if(file_exists('./application/views/blocks/'.$file.'.php')){
					$code = read_file('./application/views/backend/view.php');
					$code = str_replace('variable',$layout['name'].'_relatedId',$code);
					write_file('./application/views/blocks/'.$file.'.php',$code,'w+');
				}
			}
				elseif($type == 'carousel'){
					if(file_exists('./application/views/blocks/'.$file.'.php')){
						$code = read_file('./application/views/backend/carousel.php');
						$code = str_replace('variable',$layout['name'].'_relatedId',$code);
						write_file('./application/views/blocks/'.$file.'.php',$code,'w+');
					}
				}
		

		redirect('ignite/blockList');
	}

	// ------------------- END OF BLOCK FUNCTION -----------------------

	// ---------------- Carousel Functions ------------------

	public function carousel(){
		$data['content'] = 'backend/carousel_list';
		$data['carousels'] = $this->main_model->get_data('carousel_tbl');
		$this->load->view('template',$data);
	}

	public function editCarousel(){
		$carouselId = $this->uri->segment(3);

		$data['carousel'] = $this->main_model->get_limit_data('carousel_tbl','Id',$carouselId)->row_array();
		$data['content'] = 'backend/editCarousel';
		$this->load->view('template',$data);
	}

	public function updateCarousel(){
		$carouselId = $this->uri->segment(3);

		$name = $this->input->post('name');
		$note = $this->input->post('note');
		$type = $this->input->post('type');

		$update = array(
			'name' => $name,
			'note' => $note,
			'type' => $type
			);
		$this->db->where('Id',$carouselId);
		$this->db->update('carousel_tbl',$update);
		redirect('ignite/previewCarousel/'.$carouselId);
	}

	public function newCarouselImg(){
		$carouselId = $this->uri->segment(3);

		$data['carousel'] = $this->main_model->get_limit_data('carousel_tbl','Id',$carouselId)->row_array();

		$data['content'] = 'backend/newCarouselImg';
		$this->load->view('template',$data);
	}

	public function addCarouselImg(){
		$carouselId = $this->uri->segment(3);

		$file = $this->main_model->upload_img('carouselImg','upload_img');
		if($file != false){
			$insert = array(
				'path' => $file,
				'carouselId' => $carouselId
				);
			$this->db->insert('carousel_img_tbl',$insert);
			redirect('ignite/previewCarousel/'.$carouselId);
		}
			else{
				$data['carousel'] = $this->main_model->get_limit_data('carousel_tbl','Id',$carouselId)->row_array();
				$data['err_msg'] = 'Error : Your upload Image exceed the maximum size of limit';
				$data['content'] = 'backend/newCarouselImg';
				$this->load->view('template',$data);
			}
	}

	public function editCarouselImg(){
		$imageId = $this->uri->segment(3);

		$data['image'] = $this->main_model->get_limit_data('carousel_img_tbl','Id',$imageId)->row_array();
		$data['carousel'] = $this->main_model->get_limit_data('carousel_tbl','Id',$data['image']['carouselId'])->row_array();
		$data['content'] = 'backend/editCarouselImg';
		$this->load->view('template',$data);
	}

	public function updateCarouselImg(){
		$imageId = $this->uri->segment(3);
		$carouselId = $this->uri->segment(4);

		$image = $this->main_model->get_limit_data('carousel_img_tbl','Id',$imageId)->row_array();
		if(file_exists($image['path'])){
			unlink($image['path']);
		}

		$file = $this->main_model->upload_img('carouselImg','upload_img');
		if($file != false){
			$update = array(
				'path' => $file
				);
			$this->db->where('Id',$imageId);
			$this->db->update('carousel_img_tbl',$update);
			redirect('ignite/previewCarousel/'.$carouselId);
		}
			else{
				$data['carousel'] = $this->main_model->get_limit_data('carousel_tbl','Id',$carouselId)->row_array();
				$data['err_msg'] = 'Error : Your upload Image exceed the maximum size of limit';
				$data['content'] = 'backend/editCarouselImg';
				$this->load->view('template',$data);
			}
	}

	// -------------------------------------------------------

	// ----------- Delete Function --------------

	public function deleteAll(){
		$table = $this->uri->segment(3); // table name
		$func = $this->uri->segment(4);	// redirect function name
		$id = $this->uri->segment(5);	// Id of delete item

		echo '<h3 class="text-danger">Are you sure want to delete?</h3><br/><h4>This action cannot be undone.</h4>';
		echo '<div class="form-group mid-padding text-center">';
      	echo 	'<a href="ignite/delete/'.$table.'/'.$func.'/'.$id.'" class="btn btn-danger small-side-margin">Delete</a>';
      	echo 	'<a href="ignite/'.$func.'" class="btn btn-warning small-side-margin">Cancle</a>';
      	echo '</div>';
	}

	public function delete(){
		$table = $this->uri->segment(3);
		$func = $this->uri->segment(4);
		$id = $this->uri->segment(5);
		$this->db->where('Id',$id);
		$this->db->delete($table);
		redirect('ignite/'.str_replace('-','/',$func));
	}

	public function deleteBlock(){
		$file = $this->uri->segment(3); // table name
		$id = $this->uri->segment(4);	// Id of delete item

		echo '<h3 class="text-danger">Are you sure want to delete?</h3><br/><h4>This action cannot be undone.</h4>';
		echo '<div class="form-group mid-padding text-center">';
      	echo 	'<a href="ignite/deleteBlockFile/'.$file.'/'.$id.'" class="btn btn-danger small-side-margin">Delete</a>';
      	echo 	'<a href="ignite/blockList" class="btn btn-warning small-side-margin">Cancle</a>';
      	echo '</div>';
	}

	public function deleteBlockFile(){
		$file = $this->uri->segment(3);
		$id = $this->uri->segment(4);
		$this->db->where('Id',$id);
		$this->db->delete('blocks_tbl');

		if(file_exists('./application/views/blocks/'.$file.'.php')){
			unlink('./application/views/blocks/'.$file.'.php');
		}

		$this->db->where('blockId',$id);
		$this->db->delete('content_tbl');

		$carousel = $this->main_model->get_limit_data('carousel_tbl','blockId',$id)->row_array();

		$images = $this->main_model->get_limit_data('carousel_img_tbl','carouselId',$carousel['Id'])->result_array();
		foreach($images as $image){
			if(file_exists($image['path'])){
				unlink($image['path']);
			}
		}
		$this->db->where('carouselId',$carousel['Id']);
		$this->db->delete('carousel_img_tbl');

		$this->db->where('blockId',$id);
		$this->db->delete('carousel_tbl');

		redirect('ignite/blockList');
	}

	// ----------------------------------------------

	// ----------- Image Browse Function ----------------

	public function imageBrowse(){
		
		// loading Ckeditor ..
		$this->load->library('CKEditor');
		
		$this->ckeditor->basePath = base_url().'asset/ckeditor/';
		$this->ckeditor->config['toolbar'] =  'Full';
		$this->ckeditor->config['language'] = 'en';
		$this->ckeditor->config['font_style'] = 'myanmar';
		$this->ckeditor->config['width'] = '100%';
		$this->ckeditor->config['height'] = '300px';
		$this->ckeditor->config['filebrowserImageBrowseUrl'] = base_url().'ignite/imageBrowse';

		// ************** Pagination Start **************

		$row = $this->main_model->get_num_row('upload_img_tbl');

		$this->load->library('pagination');

		$config['base_url'] = base_url().'ignite/imageBrowse/';
		$config['total_rows'] = $row;
		$config['per_page'] = 12;
		$config['uri_segment'] = 3;

		$config['cur_tag_open'] = '<li class="active">';
		$config['cur_tag_close'] = '</li>';

		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';

		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';

		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';

		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';

		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';

		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';

		$this->pagination->initialize($config);

		$start = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		$data['images'] = $this->main_model->get_data_pagination('upload_img_tbl','Id',$start,12)->result_array();
		$this->load->view('imageBrowser',$data);
	}

	public function upload_img(){
		$file = $this->main_model->upload_file_img('userfile','upload_img');
		if($file != false){
			$insert = array(
				'name' => $file,
				'path' => 'upload_img/'.$file				
			);
			$this->db->insert('upload_img_tbl',$insert);
			redirect('ignite/imageBrowse');
		}
		
	}

	// -------------------------------------------------------------------------------

	// ------------------------ View Page ----------------------------

	public function page(){

		$id = $this->uri->segment(3);

		// ************** Pagination Start **************
		
		$row = $this->main_model->get_content_row($id);

		$this->load->library('pagination');

		$config['base_url'] = base_url().'ignite/page/'.$id.'/';
		$config['total_rows'] = $row;
		$config['per_page'] = 5;
		$config['uri_segment'] = 4;

		$config['cur_tag_open'] = '<li class="active">';
		$config['cur_tag_close'] = '</li>';

		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';

		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';

		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';

		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';

		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';

		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';

		$this->pagination->initialize($config);

		$start = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

		$data['linkStructure'] = $this->main_model->get_limit_data('link_structure_tbl','Id',$id)->row_array();

		if ($id == 1){
			redirect('ignite/index');
		}
			else{
				$data['contentDatas'] = $this->main_model->get_limit_datas_pagination('content_tbl','link',$id,'published',true,'title',$start,5)->result_array();
				$layouts = $this->main_model->get_data('layout_tbl');
				foreach ($layouts as $layout){
					$block = $this->main_model->check_block($id, $layout['Id']);
					if(!empty($block)){
						$data[$layout['name'].'_relatedId'] = $block['relatedId'];
						$data[$layout['name']] = 'blocks/'.$block['file'];
					}
					
				}
				$data['page'] = $id;
				$data['content'] = 'backend/content';
			}
		
		$this->load->view('template',$data);
	}

	// ----------------------------------------------------------------

	// -------------------- Content Functions -------------------------

	public function contentType(){
		$data['content'] = 'backend/contentType';
		$data['contentTypes'] = $this->main_model->get_data('content_type_tbl');
		$this->load->view('template',$data);
	}

	public function newContentType(){
		$data['content'] = 'backend/newContentType';
		$this->load->view('template',$data);
	}

	public function addContentType(){
		$name = $this->input->post('name');
		$note = $this->input->post('note');
		$link = $this->input->post('link');

		$insert = array(
			'name' => $name,
			'note' => $note,
			'relatedLink' => $link
			);
		$this->db->insert('content_type_tbl',$insert);
		$contentTypeId = $this->main_model->max_id('content_type_tbl');
		redirect('ignite/contentItem/'.$contentTypeId);
	}

	public function contentItem(){
		$contentTypeId = $this->uri->segment(3);

		// loading Ckeditor ..
		$this->load->library('CKEditor');
		
		$this->ckeditor->basePath = base_url().'asset/ckeditor/';
		$this->ckeditor->config['toolbar'] =  'Full';
		$this->ckeditor->config['language'] = 'en';
		$this->ckeditor->config['font_style'] = 'myanmar';
		$this->ckeditor->config['width'] = '100%';
		$this->ckeditor->config['height'] = '300px';
		$this->ckeditor->config['filebrowserImageBrowseUrl'] = base_url().'ignite/imageBrowse';

		$data['contentType'] = $this->main_model->get_limit_data('content_type_tbl','Id',$contentTypeId)->row_array();
		$data['contentItems'] = $this->main_model->get_limit_data('content_items_tbl','contentTypeId',$contentTypeId)->result_array();
		$data['content'] ='backend/contentItem';
		$this->load->view('template',$data);
	}

	public function checkItemName(){
		$name = $this->uri->segment(3);

		$check = $this->main_model->get_limit_data('content_items_tbl','name',$name)->row_array();
		if(!empty($check)){
			echo '<i class="fa fa-warning text-warning"></i> Error: File name already exist.';
		}
		
	}

	public function addContentItem(){
		$contentTypeId = $this->uri->segment(3);

		$name = $this->input->post('name');
		// $machine = $this->input->post('machine');
		$note = $this->input->post('note');
		$type = $this->input->post('type');
		$require = $this->input->post('require');
		if(empty($require)){
			$require = 0;
		}

		$insert = array(
			'name' => $name,
			// 'machine' => strtolower($machine),
			'note' => $note,
			'type' => $type,
			'required' => $require,
			'contentTypeId' => $contentTypeId
			);

		$this->db->insert('content_items_tbl',$insert);
		redirect('ignite/contentItem/'.$contentTypeId);
	}

	public function addContentByType(){
		$contentTypeId = $this->uri->segment(3);

		// loading Ckeditor ..
		$this->load->library('CKEditor');
		
		$this->ckeditor->basePath = base_url().'asset/ckeditor/';
		$this->ckeditor->config['toolbar'] =  'Full';
		$this->ckeditor->config['language'] = 'en';
		$this->ckeditor->config['font_style'] = 'myanmar';
		$this->ckeditor->config['width'] = '100%';
		$this->ckeditor->config['height'] = '300px';
		$this->ckeditor->config['filebrowserImageBrowseUrl'] = base_url().'ignite/imageBrowse';

		$data['contentType'] = $this->main_model->get_limit_data('content_type_tbl','Id',$contentTypeId)->row_array();
		$data['content'] = 'backend/addContentByType';
		$this->load->view('template',$data);
	}

	public function addContents(){
		$contentTypeId = $this->uri->segment(3);
		$contentType = $this->main_model->get_limit_data('content_type_tbl','Id',$contentTypeId)->row_array();

		$title = $this->input->post('title');
		$summary = $this->input->post('summary');
		$body = $this->input->post('body');
		if($contentType['relatedLink'] == 0){
			$link = $this->input->post('link');
		}
			else{
				$link = $contentType['relatedLink'];
			}
		$publish = $this->input->post('publish');
		$frontPage = $this->input->post('frontPage');
		if(empty($frontPage)){
			$frontPage = 0;
		}
		$showDate = $this->input->post('showDate');
		if(empty($showDate)){
			$showDate = 0;
		}
		$date = getDate();

		if($publish == true){
			$publishedDate = $date[0];
		}
			else{
				$publishedDate = 0;
			}

		$insert = array(
			'title' => $title,
			'summary' => $summary,
			'text' => $body,
			'link' => $link,
			'createdUserId' => $this->session->userdata('Id'),
			'createdDate' => $date[0],
			'published' => $publish,
			'publishedDate' => $publishedDate,
			'frontPage' => $frontPage,
			'showDate' => $showDate,
			'blockId' => 0,
			'filterId' => 0,
			'contentTypeId' => $contentType['Id']
			);

		$this->db->insert('content_tbl',$insert);
		redirect('ignite/page/'.$link);
	}

	public function allContent(){
		// ************** Pagination Start **************
		
		$row = $this->main_model->get_num_row('content_tbl');

		$this->load->library('pagination');

		$config['base_url'] = base_url().'ignite/allContent/';
		$config['total_rows'] = $row;
		$config['per_page'] = 20;
		$config['uri_segment'] = 3;

		$config['cur_tag_open'] = '<li class="active">';
		$config['cur_tag_close'] = '</li>';

		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';

		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';

		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';

		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';

		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';

		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';

		$this->pagination->initialize($config);

		$start = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		$data['contentDatas'] = $this->main_model->get_data_pagination('content_tbl','createdDate',$start,20)->result_array();
		$data['content'] = 'backend/allContent';
		$this->load->view('template',$data);
	}

	public function editContent(){
		$contentId = $this->uri->segment(3);
		$contentTypeId = $this->uri->segment(4);

		// loading Ckeditor ..
		$this->load->library('CKEditor');
		
		$this->ckeditor->basePath = base_url().'asset/ckeditor/';
		$this->ckeditor->config['toolbar'] =  'Full';
		$this->ckeditor->config['language'] = 'en';
		$this->ckeditor->config['font_style'] = 'myanmar';
		$this->ckeditor->config['width'] = '100%';
		$this->ckeditor->config['height'] = '300px';
		$this->ckeditor->config['filebrowserImageBrowseUrl'] = base_url().'ignite/imageBrowse';

		$data['contentData'] = $this->main_model->get_limit_data('content_tbl','Id',$contentId)->row_array();
		$data['contentType'] = $this->main_model->get_limit_data('content_type_tbl','Id',$contentTypeId)->row_array();
		$data['content'] = 'backend/editContent';
		$this->load->view('template',$data);
	}

	public function updateContents(){
		$contentTypeId = $this->uri->segment(3);
		$contentId = $this->uri->segment(4);
		$contentType = $this->main_model->get_limit_data('content_type_tbl','Id',$contentTypeId)->row_array();

		$title = $this->input->post('title');
		$summary = $this->input->post('summary');
		$body = $this->input->post('body');
		if($contentType['relatedLink'] == 0){
			$link = $this->input->post('link');
		}
			else{
				$link = $contentType['relatedLink'];
			}
		$publish = $this->input->post('publish');
		$frontPage = $this->input->post('frontPage');
		if(empty($frontPage)){
			$frontPage = 0;
		}
		$showDate = $this->input->post('showDate');
		if(empty($showDate)){
			$showDate = 0;
		}
		$date = getDate();

		if($publish == true){
			$publishedDate = $date[0];
		}
			else{
				$publishedDate = 0;
			}

		$update = array(
			'title' => $title,
			'summary' => $summary,
			'text' => $body,
			'link' => $link,
			'published' => $publish,
			'publishedDate' => $publishedDate,
			'frontPage' => $frontPage,
			'showDate' => $showDate,
			);

		$this->db->where('Id',$contentId);
		$this->db->update('content_tbl',$update);
		redirect('ignite/page/'.$link);
	}

	public function contentView(){
		$contentId = $this->uri->segment(3);

		$data['contentData'] = $this->main_model->get_limit_data('content_tbl','Id',$contentId)->row_array();
		$layouts = $this->main_model->get_data('layout_tbl');
		foreach ($layouts as $layout){
			$block = $this->main_model->check_block($data['contentData']['link'], $layout['Id']);
			if(!empty($block)){
				$data[$layout['name'].'_relatedId'] = $block['relatedId'];
				$data[$layout['name']] = 'blocks/'.$block['file'];
			}
			
		}
		$data['page'] = $data['contentData']['link'];
		$data['content'] = 'backend/contentView';
		$this->load->view('template',$data);
	}

	// ----------------------------------------------------------------

	// ------------------------- Logout Function ----------------------

	public function logout(){
		$this->session->sess_destroy();
		redirect('ignite/index');
	}

	// --------------------------- User Functions -----------------------------

	public function user_setting(){
		$userId = $this->uri->segment(3);

		$data['userData'] = $this->main_model->get_limit_data('users_tbl','Id',$userId)->row_array();
		$data['content'] = 'backend/userSetting';
		$this->load->view('template',$data);
	}

	public function updateUser(){
		$userId = $this->uri->segment(3);

		$name = $this->input->post('name');
		$password = $this->input->post('password');

		$update = array(
			'name' => $name,
			'password' => md5($password)
			);

		$this->db->where('Id',$userId);
		$this->db->update('users_tbl',$update);
		redirect('login/index');
	}

	// ---------------------------------------------------------------------

	// ------------------------ Function Setting ---------------------------

	public function setting(){
		$data['content'] = 'backend/setting';
		$this->load->view('template',$data);
	}

	public function newUser(){
		$data['content'] = 'backend/newUser';
		$this->load->view('template',$data);
	}

	public function addUser(){
		$username = $this->input->post('username');
		$name = $this->input->post('name');
		$password = $this->input->post('password');
		$level = $this->input->post('level');
		$activate = $this->input->post('state');
		if(empty($activate)){
			$activate = 0;
		}

		$insert = array(
			'userName' => $username,
			'name' => $name,
			'password' => md5($password),
			'userLevel' => $level,
			'activate' => $activate
			);
		$this->db->insert('users_tbl',$insert);
		redirect('ignite/allUsers');
	}

	public function editUser(){
		$userId = $this->uri->segment(3);

		$data['user'] = $this->main_model->get_limit_data('users_tbl','Id',$userId)->row_array();
		$data['content'] = 'backend/editUser';
		$this->load->view('template',$data);
	}

	public function checkUserName(){
		$name = $this->uri->segment(3);

		$check = $this->main_model->get_limit_data('users_tbl','userName',$name)->row_array();
		if(!empty($check)){
			echo '<i class="fa fa-warning text-warning"></i> Error: Username already exist.';
		}
	}

	public function updateUserByAdmin(){
		$userId = $this->uri->segment(3);

		$name = $this->input->post('name');
		$password = $this->input->post('password');
		$level = $this->input->post('level');
		$state = $this->input->post('state');
		if(empty($state)){
			$state = 0;
		}

		$update = array(
			'name' => $name,
			'password' => md5($password),
			'userLevel' => $level,
			'activate' => $state
			);

		$this->db->where('Id',$userId);
		$this->db->update('users_tbl',$update);
		redirect('ignite/allUsers');
	}

	public function allUsers(){
		$data['users'] = $this->main_model->get_data('users_tbl');
		$data['content'] = 'backend/allUsers';
		$this->load->view('template',$data);
	}

	// ---------------------------------------------------------------------
	
	public function contact_email(){
		$data['title'] = $this->input->post('title');
		$data['email'] = $this->input->post('email');
		$data['subject'] = $this->input->post('subject');
		$data['message'] = $this->input->post('message');

		$mailBody = $this->load->view('userfiles/email_template',$data,TRUE);

		$config['mailtype'] = 'html';
		$this->email->initialize($config);

		$this->load->library('email');

		$this->email->from($data['email']);
		$this->email->to('msp@myanmarsolarpower.net');
		$this->email->subject($data['subject']);
		$this->email->message($mailBody);

		$this->email->send();

		redirect('ignite/index');
	}

	public function write(){
		if(!file_exists('./application/views/blocks/main_menu.php')){
			$code = read_file('./application/views/backend/menu.php');
			$code = str_replace('variable','nav_relatedId',$code);
			// chmod('./application/views/blocks/', 0755);
			if(write_file(FCPATH .'/application/views/blocks/main_menu.php',$code,'w')){
				echo 'writed';
			}
			else{
				echo 'Oops, Something wrong !';
			}
		}
	}
}
