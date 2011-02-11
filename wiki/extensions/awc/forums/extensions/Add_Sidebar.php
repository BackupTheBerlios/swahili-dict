<?php
/*
 *Name:    Forum Addon: Display Forum Navibar in Sidebar
 *Version: 0.1rc1
 *Support:
 *Autor:   Bernhard Eisele (http://www.freggers-wiki.de)
 */
$wgHooks['SkinBuildSidebar'][] = 'AWC_FORUMS_SidebarUrls';

function AWC_FORUMS_SidebarUrls($skin, &$bar) {
        global $wgUser,$awcUser;

		if(awcs_show_SidebarUrls){ //Alows you to deaktivate in config.php
			if($awcsf_forums_sidebarurls == 'yes') return true ;//Fix SocialProfil
				$awcsf_forums_sidebarurls = 'yes';

				require_once(awc_dir . "includes/funcs.php"); //Allows to use when whoes here and menu deaktivated
				require_once(awc_dir . "includes/gen_class.php");
				awcs_forum_wfLoadExtensionMessages( 'AWCforum_menu' );// Language File

				if(!$wgUser->isLoggedIn()){ //Shows when not Logged In
					$bar_awc_forum[wfMsg('awcf_forum_menu')][] =
						array(
							text   => ''.wfMsg('awcf_forum').'',
							href   => ''.awc_url.'',
							id     => 'n-awc-forum-urls',
							active => ''
						);
					$bar_awc_forum[wfMsg('awcf_forum_menu')][] =
						array(
							text   => ''.wfMsg('awcf_search').'',
							href   => ''.awc_url.'search',
							id     => 'n-awc-forum-urls',
							active => ''
						);
					$bar_awc_forum[wfMsg('awcf_forum_menu')][] =
						array(
							text   => ''.wfMsg('awcf_todays_posts').'',
							href   => ''.awc_url.'search/todate',
							id     => 'n-awc-forum-urls',
							active => ''
						);
				}else{ //Shows when Logged in

                    if(empty($awcUser) OR $awcUser->has_mem_info == false) {
						$awcUser->get_mem_forum_options(); // set
					}

					if(isset($awcUser->m_pmunread )){
                        $user_title = '('. $awcUser->m_pmunread . ')' ;
							if(isset($awcUser->m_pmpop) AND isset($awcUser->m_pmoptions['m_pmpop']) ){
								if($awcUser->m_pmpop == '1' AND
									$awcUser->m_pmoptions['m_pmpop'] == '1'){
								   global $wgOut, $wgTitle;
								   if( $wgTitle->mDbkeyform!= 'AWCforum') $wgOut->addHTML('<script type= "text/javascript">  alert("'.wfMsg('awcf__newpm').'"); </script>');
								}
							}
                    } else {
                        $user_title = '0' ;

					}

                    $user_title .= ' ' . wfMsg('awcf_unreadpms');

                    $mOps = (isset($awcUser->m_menu_options)) ? $awcUser->m_menu_options : null ;
                    if(!is_array($mOps) OR !isset($mOps) OR empty($mOps)){
						$mOps['pms'] = true ;
						$mOps['recent'] = true ;
						$mOps['mythreads'] = true ;
						$mOps['myposts'] = true ;
						$mOps['subemail'] = true ;
						$mOps['sublist'] = true ;
						$mOps['search'] = true ;
						$mOps['today'] = true ;
						$mOps['forum'] = true ;
                    }

                        if($mOps['forum'])
							$bar_awc_forum[wfMsg('awcf_forum_menu')][] =
								array(
									text   => ''.wfMsg('awcf_forum').'',
									href   => ''.awc_url.'',
									id     => 'n-awc-forum-urls',
									active => ''
								);
                        if($mOps['search'])
							$bar_awc_forum[wfMsg('awcf_forum_menu')][] =
								array(
									text   => ''.wfMsg('awcf_search').'',
									href   => ''.awc_url.'search',
									id     => 'n-awc-forum-urls',
									active => ''
								);
                        if($mOps['today'])
							$bar_awc_forum[wfMsg('awcf_forum_menu')][] =
								array(
									text   => ''.wfMsg('awcf_todays_posts').'',
									href   => ''.awc_url.'search/todate',
									id     => 'n-awc-forum-urls',
									active => ''
								);
                        if($mOps['pms'])
							$bar_awc_forum[wfMsg('awcf_forum_menu')][] =
								array(
									text   => ''.$user_title.'',
									href   => ''.awc_url.'member_options/pminbox',
									id     => 'n-awc-forum-urls',
									active => ''
								);

                        if($mOps['recent'])
							$bar_awc_forum[wfMsg('awcf_forum_menu')][] =
								array(
									text   => ''.wfMsg('awcf_recent').'',
									href   => ''.awc_url.'search/recent',
									id     => 'n-awc-forum-urls',
									active => ''
								);
                        if($mOps['mythreads'])
							$bar_awc_forum[wfMsg('awcf_forum_menu')][] =
								array(
									text   => ''.wfMsg('awcf_my_threads').'',
									href   => ''.awc_url.'search/memtopics/'.$wgUser->mName.'/'.$awcUser->mId.'',
									id     => 'n-awc-forum-urls',
									active => ''
								);
                        if($mOps['myposts'])
							$bar_awc_forum[wfMsg('awcf_forum_menu')][] =
								array(
									text   => ''.wfMsg('awcf_my_posts').'',
									href   => ''.awc_url.'search/memposts/'.$wgUser->mName.'/'.$awcUser->mId.'',
									id     => 'n-awc-forum-urls',
									active => ''
								);
                        if($mOps['subemail'])
							$bar_awc_forum[wfMsg('awcf_forum_menu')][] =
								array(
									text   => ''.wfMsg('awcf_sub_email').'',
									href   => ''.awc_url.'member_options/threadsubscribe_email',
									id     => 'n-awc-forum-urls',
									active => ''
								);
                        if($mOps['sublist'])
							$bar_awc_forum[wfMsg('awcf_forum_menu')][] =
								array(
									text   => ''.wfMsg('awcf_sub_list').'',
									href   => ''.awc_url.'member_options/threadsubscribe_list',
									id     => 'n-awc-forum-urls',
									active => ''
								);
				}

				//Adds the array to the navibar
				if(awcs_forum_nav_bar_top){
                    $bar = array_merge ($bar_awc_forum,$bar);
				} else{
                    $bar = array_merge ($bar,$bar_awc_forum);
				}
				//Testing
				/*echo "<!--";
				print_r ($bar);
				echo "-->";*/
		}
        return true;
}