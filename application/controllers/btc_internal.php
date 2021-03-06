<?php


/**
 * Bitcoin Internal Callbacks Controllers
 *
 * This controller deals with requests from the bitcoin daemon regarding
 * new transactions, and blocks.
 * 
 * @package		BitWasp
 * @subpackage	Controllers
 * @category	Bitcoin_Internal
 * @author		BitWasp
 * 
 */

class Btc_internal extends CI_Controller {


	/**
	 * Constructor
	 *
	 * @access	public
	 * @see		Models/Bitcoin_Model
	 * @see		Libraries/Bw_Bitcoin
	 */
	public function __construct() {
		parent::__construct();
		$this->load->library('bw_bitcoin');
		$this->load->model('bitcoin_model');
	} 
	
	/**
	 * Not fully implemented - start logging blocks to give an epoch to 
	 * scan from. Ones from before this will be ignored.
	 *
	 * @see		Models/Bitcoin_Model
	 * @see		Libraries/Bw_Bitcoin
	 */
	public function install_config() {
		$bitcoin_info = $this->bw_bitcoin->getinfo();
		$latest_hash = $this->bw_bitcoin->getblockhash($bitcoin_info['blocks']);
		//$this->bitcoin_model->add_block($latest_hash, $bitcoin_info['blocks']);
		print_r($latest_hash);
	}
	

	/**
	 * WalletNotify function - Inform site about transactions affecting
	 * the wallet.
	 * URI: /callback/wallet/$txn_id
	 *
	 * @access	public
	 * @see		Models/Bitcoin_Model
	 * @see		Libraries/Bw_Bitcoin
	 */	
	public function walletnotify($txn_id){
		$this->bw_bitcoin->walletnotify($txn_id);
	}
		
	/**
	 * BlockNotify function - Inform site about a new block.
	 * Also important for updating confirmations of transactions.
	 * URI: /callback/block/$block_hash
	 * 
	 * @access	public
	 * @see		Libraries/Bw_Bitcoin
	 */
	public function blocknotify($block_hash){
		$this->bw_bitcoin->blocknotify($block_hash);
	}

	/**
	 * Rate notify callback. Used by cronjobs, or for manual testing */
	public function ratenotify(){
		$this->bw_bitcoin->ratenotify();
	}

	/**
	 * Used for testing - clear bitcoin transactions.
	 * URI: /bitcoin/reset
	 * 
	 * @param	string
	 * @see 	Models/Messages_Model
	 * @see		Models/Items_Model
	 * @see		Libraries/Form_Validation
	 * @return	void
	 */	
/*
	public function reset(){
		$this->bitcoin_model->reset_a();
	}*/
};
