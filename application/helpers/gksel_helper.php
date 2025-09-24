<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	function fy_backend($total,$row,$url,$page=10,$num_links=5,$url_type=1){

		//$total数据总数

		//$row数据第几个开始

		//$page每页显示几篇文章

		//$num_links左右两边显示个数

		if($row==0){$cur_page=1;}else{$cur_page=($row/$page)+1;}//当前页

		$yeshu=ceil($total/$page);//总页数

		$prev_row=$row-$page;//上一页的$row数据第几个开始

		$next_row=$row+$page;//下一页的$row数据第几个开始

		

		$first_open='<span class="page">';

		$first_close='</span>&nbsp;';

		$last_open='<span class="page">';

		$last_close='</span>&nbsp;';

		

		$omission='<span style="color:black;">...</span>&nbsp;';                        //省略显示的内容   通常是 " ... "

		$next='<span style="color:black;padding:2px 5px 2px 5px;border:1px solid #bababa;">'.lang('cy_next_page').'</span>';                       //自定义上一页的内容   通常是 "&gt;&gt;"

		$next_open='<span class="go_b" style="color:black;">';                       //自定义上一页的内容   通常是 "&gt;&gt;"

		$next_close='</span>&nbsp;';                       //自定义上一页的内容   通常是 "&gt;&gt;"

		$prev='<span style="color:black;padding:2px 5px 2px 5px;border:1px solid #bababa;">'.lang('cy_prev_page').'</span>';                       //自定义下一页的内容  通常是 "&lt;&lt;"

		$prev_open='<span class="go_b" style="color:black;">';                       //自定义下一页的内容  通常是 "&lt;&lt;"

		$prev_close='</span>&nbsp;';                       //自定义下一页的内容  通常是 "&lt;&lt;"

		$tag_open='<span style="color:black;padding:2px 5px 2px 5px;border:1px solid #bababa;">';                          //数字的打开标签  通常是 "["

		$tag_close='</span>&nbsp;';                         //数字的关闭标签  通常是 "]"

		$cur_tag_open='<span style="background:black;color:white;padding:2px 5px 2px 5px;border:1px solid #bababa;font-weight:bold;">';    //当前页的打开标签  通常是 "<font color="red">["

		$cur_tag_close='</span>&nbsp;';              //当前页的关闭标签  通常是 "]</font>"

		

		$linkstyle='text-decoration: none;color:black;'; //链接的样式  通常是 "text-decoration: none;color:black;"



		if($url_type==2){

			$url_type_text='&row=';

		}else{

			$url_type_text='/';

		}

		//  echo $yeshu;exit;

		if($yeshu>$num_links){

			for($i=1;$i<=$num_links+1;$i++){

				${"linkl_".$i}=$cur_page-$i;

					$link_l=${"linkl_".$i};

				${"linkr_".$i}=$cur_page+$i;

					$link_r=${"linkr_".$i};



				$row_prev=($link_l-1)*$page;

				$row_next=($link_r-1)*$page;



				if($i<=$num_links){

					if($link_l>0){$number_l='<a style="'.$linkstyle.'" href="'.$url.$url_type_text.$row_prev.'">'.$tag_open.$link_l.$tag_close.'</a>';}else{$number_l='';}

					if($link_r<=$yeshu){$number_r='<a style="'.$linkstyle.'" href="'.$url.$url_type_text.$row_next.'">'.$tag_open.$link_r.$tag_close.'</a>';}else{$number_r='';}

				}else{

					if($link_l>0){$number_l=$first_open.'<a style="'.$linkstyle.'" href="'.$url.'">1</a>'.$first_close.$omission;}else{$number_l='';} //显示第1页

					if($link_r<=$yeshu){$number_r=$omission.$first_open.'<a style="'.$linkstyle.'" href="'.$url.$url_type_text.($yeshu-1)*$page.'">'.$yeshu.'</a>'.$first_close;}else{$number_r='';}//显示最后1页



					if($cur_page>1){

						$number_l =$prev_open.'<a style="'.$linkstyle.'" href="'.$url.$url_type_text.$prev_row.'">'.$prev.'</a>'.$prev_close.$number_l;

					}else{

						$number_l =''.$number_l;

					}

					if($cur_page<$yeshu){

						$number_r .=$next_open.'<a style="'.$linkstyle.'" href="'.$url.$url_type_text.$next_row.'">'.$next.'</a>'.$next_close;

					}else{

						$number_r .='';

					}

				}

				${"contentl_".$i}=$number_l;

				${"contentr_".$i}=$number_r;

			}



			$data['create_line']='';

			for($i=$num_links+1;$i>=1;$i--){

				$row_prev=$row-$page;

				$data['create_line'] .=${"contentl_".$i};//输出左边页

			}

			$data['create_line'] .=$cur_tag_open.$cur_page.$cur_tag_close;  //输出当前页



			for($i=1;$i<=$num_links+1;$i++){

				$row_next=$row+$page;

				$data['create_line'] .=${"contentr_".$i};//输出右边页

			}

		}else{

			$data['create_line']='';

			if($cur_page>1){

				$data['create_line'] .=$prev_open.'<a style="'.$linkstyle.'" href="'.$url.$url_type_text.$prev_row.'">'.$prev.'</a>'.$prev_close;

			}

			if($yeshu>1){

				for($i=1;$i<=$yeshu;$i++){

					$row_prev=($i-1)*$page;



					if($i==$cur_page){

						$data['create_line'] .=$cur_tag_open.$i.$cur_tag_close;

					}else{

						$data['create_line'] .='<a style="'.$linkstyle.'" href="'.$url.$url_type_text.$row_prev.'">'.$tag_open.$i.$tag_close.'</a>';

					}

				}

			}

			if($cur_page<$yeshu){

				$data['create_line'] .=$next_open.'<a style="'.$linkstyle.'" href="'.$url.$url_type_text.$next_row.'">'.$next.'</a>'.$next_close;

			}

		}

		return $data['create_line'];

	}

	

	

	function fy_frontend($total,$row,$url,$page=10,$num_links=5,$url_type=1){

	    //$total数据总数

	    //$row数据第几个开始

	    //$page每页显示几篇文章

	    //$num_links左右两边显示个数

	    if($row==0){$cur_page=1;}else{$cur_page=($row/$page)+1;}//当前页

	    $yeshu=ceil($total/$page);//总页数

	    $prev_row=$row-$page;//上一页的$row数据第几个开始

	    $next_row=$row+$page;//下一页的$row数据第几个开始

	    

	    $first_open='<span class="page">';

	    $first_close='</span>&nbsp;';

	    $last_open='<span class="page">';

	    $last_close='</span>&nbsp;';

	    

	    $omission='<span style="color:black;">...</span>&nbsp;';                        //省略显示的内容   通常是 " ... "

	    $next='<span style="color:black;padding:2px 5px 2px 5px;border:1px solid #bababa;">'.lang('cy_next_page').'</span>';                       //自定义上一页的内容   通常是 "&gt;&gt;"

	    $next_open='<span class="go_b" style="color:black;">';                       //自定义上一页的内容   通常是 "&gt;&gt;"

	    $next_close='</span>&nbsp;';                       //自定义上一页的内容   通常是 "&gt;&gt;"

	    $prev='<span style="color:black;padding:2px 5px 2px 5px;border:1px solid #bababa;">'.lang('cy_prev_page').'</span>';                       //自定义下一页的内容  通常是 "&lt;&lt;"

	    $prev_open='<span class="go_b" style="color:black;">';                       //自定义下一页的内容  通常是 "&lt;&lt;"

	    $prev_close='</span>&nbsp;';                       //自定义下一页的内容  通常是 "&lt;&lt;"

	    $tag_open='<span style="color:black;padding:2px 5px 2px 5px;border:1px solid #bababa;">';                          //数字的打开标签  通常是 "["

	    $tag_close='</span>&nbsp;';                         //数字的关闭标签  通常是 "]"

	    $cur_tag_open='<span style="background:#CE1F7C;color:white;padding:2px 5px 2px 5px;border:1px solid #bababa;font-weight:bold;">';    //当前页的打开标签  通常是 "<font color="red">["

	    $cur_tag_close='</span>&nbsp;';              //当前页的关闭标签  通常是 "]</font>"

	    

	    $linkstyle='text-decoration: none;color:black;'; //链接的样式  通常是 "text-decoration: none;color:black;"

	    

	    if($url_type == 2){

	        $url_type_text='&row=';

	    }else if($url_type == 3){

	        $url_type_text='?row=';

	    }else{

	        $url_type_text='/';

	    }

	    //  echo $yeshu;exit;

	    if($yeshu>$num_links){

	        for($i=1;$i<=$num_links+1;$i++){

	            ${"linkl_".$i}=$cur_page-$i;

	            $link_l=${"linkl_".$i};

	            ${"linkr_".$i}=$cur_page+$i;

	            $link_r=${"linkr_".$i};

	            

	            $row_prev=($link_l-1)*$page;

	            $row_next=($link_r-1)*$page;

	            

	            if($i<=$num_links){

	                if($link_l>0){$number_l='<a style="'.$linkstyle.'" href="'.$url.$url_type_text.$row_prev.'">'.$tag_open.$link_l.$tag_close.'</a>';}else{$number_l='';}

	                if($link_r<=$yeshu){$number_r='<a style="'.$linkstyle.'" href="'.$url.$url_type_text.$row_next.'">'.$tag_open.$link_r.$tag_close.'</a>';}else{$number_r='';}

	            }else{

	                if($link_l>0){$number_l=$first_open.'<a style="'.$linkstyle.'" href="'.$url.'">1</a>'.$first_close.$omission;}else{$number_l='';} //显示第1页

	                if($link_r<=$yeshu){$number_r=$omission.$first_open.'<a style="'.$linkstyle.'" href="'.$url.$url_type_text.($yeshu-1)*$page.'">'.$yeshu.'</a>'.$first_close;}else{$number_r='';}//显示最后1页

	                

	                if($cur_page>1){

	                    $number_l =$prev_open.'<a style="'.$linkstyle.'" href="'.$url.$url_type_text.$prev_row.'">'.$prev.'</a>'.$prev_close.$number_l;

	                }else{

	                    $number_l =''.$number_l;

	                }

	                if($cur_page<$yeshu){

	                    $number_r .=$next_open.'<a style="'.$linkstyle.'" href="'.$url.$url_type_text.$next_row.'">'.$next.'</a>'.$next_close;

	                }else{

	                    $number_r .='';

	                }

	            }

	            ${"contentl_".$i}=$number_l;

	            ${"contentr_".$i}=$number_r;

	        }

	        

	        $data['create_line']='';

	        for($i=$num_links+1;$i>=1;$i--){

	            $row_prev=$row-$page;

	            $data['create_line'] .=${"contentl_".$i};//输出左边页

	        }

	        $data['create_line'] .=$cur_tag_open.$cur_page.$cur_tag_close;  //输出当前页

	        

	        for($i=1;$i<=$num_links+1;$i++){

	            $row_next=$row+$page;

	            $data['create_line'] .=${"contentr_".$i};//输出右边页

	        }

	    }else{

	        $data['create_line']='';

	        if($cur_page>1){

	            $data['create_line'] .=$prev_open.'<a style="'.$linkstyle.'" href="'.$url.$url_type_text.$prev_row.'">'.$prev.'</a>'.$prev_close;

	        }

	        if($yeshu>1){

	            for($i=1;$i<=$yeshu;$i++){

	                $row_prev=($i-1)*$page;

	                

	                if($i==$cur_page){

	                    $data['create_line'] .=$cur_tag_open.$i.$cur_tag_close;

	                }else{

	                    $data['create_line'] .='<a style="'.$linkstyle.'" href="'.$url.$url_type_text.$row_prev.'">'.$tag_open.$i.$tag_close.'</a>';

	                }

	            }

	        }

	        if($cur_page<$yeshu){

	            $data['create_line'] .=$next_open.'<a style="'.$linkstyle.'" href="'.$url.$url_type_text.$next_row.'">'.$next.'</a>'.$next_close;

	        }

	    }

	    return $data['create_line'];

	}

	

	function fy_ajax($total,$row,$page=10,$fangfa,$fangfa_canshu=''){

	  //$total数据总数

	  //$row数据第几个开始

	  //$page每页显示几篇文章

	  if($row==0){$cur_page=1;}else{$cur_page=($row/$page)+1;}//当前页

	  $yeshu=ceil($total/$page);//总页数

	  $prev_row=$row-$page;//上一页的$row数据第几个开始

	  $next_row=$row+$page;//下一页的$row数据第几个开始

	  

		$next='<div style="float:left;background-color: #a6593f;color: white;font-size: 16px;height: 30px;width: auto;padding: 0px 10px 0px 10px;line-height: 30px;text-transform: uppercase;border-radius:5px;-moz-border-radius:5px;-webkit-border-radius:5px;">'.lang('cy_next_page').'</div>';                       //自定义上一页的内容   通常是 "&gt;&gt;"

		$prev='<div style="float:left;background-color: #a6593f;color: white;font-size: 16px;height: 30px;width: auto;padding: 0px 10px 0px 10px;line-height: 30px;text-transform: uppercase;border-radius:5px;-moz-border-radius:5px;-webkit-border-radius:5px;">'.lang('cy_prev_page').'</div>';                       //自定义下一页的内容  通常是 "&lt;&lt;"

		$linkstyle='text-decoration: none;color:white;'; //链接的样式  通常是 "text-decoration: none;color:black;"

	//  echo $yeshu;exit;

  	    $data['create_line']='';

  		if($cur_page>1){

	  		$data['create_line'] .='<a onclick="'.$fangfa.'('.$fangfa_canshu.$prev_row.')" style="'.$linkstyle.'" href="javascript:;">'.$prev.'</a>';

	  	}

  		if($cur_page<$yeshu){

	  	    $data['create_line'] .='<a onclick="'.$fangfa.'('.$fangfa_canshu.$next_row.')" style="'.$linkstyle.'" href="javascript:;">'.$next.'</a>';

  	    }

	  return $data['create_line'];

  }

	

	/*

	 * 判断客户登录客户端

	 * */

	function checkagent(){

		$agent = strtolower($_SERVER['HTTP_USER_AGENT']);  

	    $is_pc = (strpos($agent, 'windows nt')) ? true : false;  

	    $is_iphone = (strpos($agent, 'iphone')) ? true : false;  

	    $is_ipad = (strpos($agent, 'ipad')) ? true : false;  

	    $is_android = (strpos($agent, 'android')) ? true : false;  

	   

	    if($is_ipad){  

	        return 'ipad';

	    }else{

	     	if($is_iphone){  

	        	return 'iphone';

		    }else{

				if($is_android){

			    	return 'android';

			    }else{

			    	return 'pc';

			    }

		    }

	    }

	}

	

	//获取 all

	function randkey($num){

    	$string = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

		$randkey='';

		for($i = 0;$i < $num;$i++){

			$str = $string[rand(0,61)];

			$randkey.= $str;

		}

		return $randkey;

    }

    

    //获取 数字

	function randkey_number($num){

    	$string = "123456789";

		$randkey='';

		for($i = 0;$i < $num;$i++){

			$str = $string[rand(0,8)];

			$randkey.= $str;

		}

		return $randkey;

    }

	/**

	 * 获取字符串长度(汉字算2个字符)

	 */

    function getstrlen($str = ''){

        if($str != ''){

            $str = strip_tags($str);

            $length = strlen(preg_replace('/[x00-x7F]/', '', $str));

            if ($length){

                return strlen($str) - $length + intval($length / 3) * 2;

            }else{

                return strlen($str);

            }

        }else{

            return '';

        }

	}

	/**

	 * 截取字符串(汉字算2个字符并且防止截出乱码--目前只支持从第0位开始截取)

	 *

	 * @param String $string 要截取的字符串

	 * @param Int $start 从第几位开始截

	 * @param Int $length 要截取的长度

	 * @param String $fixStr 当字符长度大于$end时，给字符追加的字符

	 */

	function get_substr($string,$start,$length = null,$fixStr = 0){

		$string = strip_tags($string);

		$strRes = '';

	    if (!$string || empty($string)) {

	        return $string;

	    }

 

	    $maxLen = ($length) ? $length - $start : $start;

	    $j = $start;

	    for ($i = $start; $i < $maxLen; $i++){

	        if (ord(mb_substr($string, $j, 1,'UTF-8')) > 0xa0) {

	            if ($i + 1 == $maxLen) {

	                //如果截取的最后一字是汉字，那么舍弃该汉字，结束截取

// 	                -- 暂不截取

// 	                $strRes .= '<span>'.mb_substr($string, $j, 2,'UTF-8').'</span>';

	                break;

	            }else {

	                //如果是中文，截取2个字符

//	                $strRes .= mb_substr($string, $i, 2,'UTF-8');

//	                $i++;

	                $strRes .= mb_substr($string, $j, 1,'UTF-8');

	                $i++;

	            }

	        }else {

	            //如果是英文，截取1个字符

	            $strRes .= mb_substr($string, $j, 1,'UTF-8');

	        }

	        $j++;

	    }

	    if($fixStr==1){

		     if(getstrlen($string)>$maxLen){

		    	 $strRes .= '…';

		   	 }

	    }

	    return $strRes;

	}

	

	//将字符串使用 span 分割

	function wordsplitwidthspan($string, $langtype = '_en'){

	    return $string;

//         if($string != ''){

//             $string = str_replace('&nbsp;', '', $string);

//             $string = strip_tags($string);

//             $string = trim($string);

//             $string = $string.'  ';

            

// //             $new_str = '';

// //             $explodetitle = explode(' ', $string);

// //             if(!empty($explodetitle)){

// //                 for ($e = 0; $e < count($explodetitle); $e++) {

// //                     $new_str .= '<span>'.$explodetitle[$e].'&nbsp;</span>';

// //                 }

// //             }

// //             //判断当前有几个 span

// //             if(count(explode('<span>', $new_str)) == 2){//表示只有一个 span 应该是开头和结尾

// //                 $new_str = str_replace('<span>', '', $new_str);

// //                 $new_str = str_replace('&nbsp;</span>', '', $new_str);

// //                 $new_str = trim($new_str);

// //                 $string = $new_str;



//                 $maxLen = getstrlen($string);

                    

//                 $strRes = '';

                

//                 $j = 0;

//                 for ($i = 0; $i < $maxLen; $i++){

//                     if (ord(mb_substr($string, $j, 1,'UTF-8')) > 0xa0) {

//                         if ($i + 1 == $maxLen) {

//                             //如果截取的最后一字是汉字，那么舍弃该汉字，结束截取 -- 暂不截取

//                             $strRes .= '<span>'.mb_substr($string, $j, 1,'UTF-8').'</span>';

//                             $i++;

//                             break;

//                         }else {

//                             //如果是中文，截取2个字符

//                             //$strRes .= mb_substr($string, $i, 2,'UTF-8');

//                             //$i++;

//                             $strRes .= '<span>'.mb_substr($string, $j, 1,'UTF-8').'</span>';

//                             $i++;

//                         }

//                     }else {

//                         //如果是英文，截取1个字符

//                         if(mb_substr($string, $j, 1,'UTF-8') == ' '){

//                             $strRes .= '<span>&nbsp;</span>';

//                         }else{

//                             $strRes .= '<span>'.mb_substr($string, $j, 1,'UTF-8').'</span>';

//                         }

//                     }

//                     $j++;

//                 }

//                 $return_str = $strRes;

// //             }else{

// //                 $return_str = $new_str;

// //             }

//             return $return_str;

//         }else{

//             return '';

//         }

	}

	

	//获取语言的列表

	function languagelist() {

		$CI =& get_instance();

		$lan = $CI->WelModel->getlanguage_list(array('status'=>1,'orderby'=>'sort','orderby_res'=>'ASC'));

	    return $lan;

	}

	/*替换内容*/

	function replace_content($reparr,$content) {

		if(!empty($reparr)){

			

		}else{

			$reparr = array();

		}

		if(!empty($reparr)){

			for($i=0;$i<count($reparr);$i++){

				$content=str_replace($reparr[$i]['name'],$reparr[$i]['value'],$content);

			}

		}

		

	    return $content;

	}

	

	/*替换内容*/

	function preg_replace_content($rep_arr, $content){

		if(!empty($rep_arr)){

			for ($r = 0; $r < count($rep_arr); $r++) {

				$content = preg_replace($rep_arr[$r]['rep_start'], $rep_arr[$r]['rep_to'], $content);

			}

		}

		return $content;

	}

	

	//默认替换内容

	function defaultreparr(){

		$reparr = array();

		$reparr[] = array('name'=>"{sign_douhao}", 'value'=>"'");

		$reparr[] = array('name'=>"<br />", 'value'=>"\n");

		$reparr[] = array('name'=>base_url(), 'value'=>"{base_url}");

		$reparr[] = array('name'=>'/(width:(\s)*(\d){1,3}(%|(px));(\s)height:(\s)*(\d){1,3}(%|(px));)/', 'value'=>"max-width:100%;");

		return $reparr;

	}

	function pregreparr(){

		$reparr = array();

		$rep_start = '/(img src=)/';

		$rep_to = 'img style="max-width:100%;" src=';

		$reparr[] = array('rep_start'=>$rep_start, 'rep_to'=>$rep_to);

		 

		$rep_start = '/(height="(\s)*(\d){1,3}")/';

		$rep_to = '';

		$reparr[] = array('rep_start'=>$rep_start, 'rep_to'=>$rep_to);

		 

		$rep_start = '/(width:(\s)*(\d){1,3}(%|(px));(\s)height:(\s)*(\d){1,3}(%|(px));)/';

		$rep_to = "max-width:100%;";

		$reparr[] = array('rep_start'=>$rep_start, 'rep_to'=>$rep_to);

		 

		$rep_start = '/(width:(\s)*(\d){1,3}(%|(px));)/';

		$rep_to = "max-width:100%;";

		$reparr[] = array('rep_start'=>$rep_start, 'rep_to'=>$rep_to);

		 

		return $reparr;

	}

	/*文件或图片的路径*/

	function enable_filepath($filepath) {

		$filepathsp = explode("http", $filepath);

		if(count($filepathsp)>=2){

			$fileshowpath = $filepath;

		}else{

			$fileshowpath = CDN_URL().$filepath;

		}

		return $fileshowpath;

	}

	/*编译转化{base_url}*/

	function enbaseurlcontent($content) {

		$reparr=array();

		$reparr[]=array('name'=>base_url(),'value'=>'{base_url}');

		for($i=0;$i<count($reparr);$i++){

			$content=str_replace($reparr[$i]['name'],$reparr[$i]['value'],$content);

		}

	    return $content;

	}

	/*解编译转化base_url()*/

	function debaseurlcontent($content) {

		$reparr = array();

		$reparr[] = array('name'=>'{base_url}','value'=>base_url());

		$reparr[] = array('name'=>'{sign_douhao}','value'=>"'");

		$reparr[] = array('name'=>'/wordpressnostress','value'=>"");

		for($i=0;$i<count($reparr);$i++){

			$content=str_replace($reparr[$i]['name'],$reparr[$i]['value'],$content);

		}

	    return $content;

	}

	

	// js, css, 音频, 图片等使用的缓存标记

	function CACHE_USETIME(){

		$CI = & get_instance();

		$cache_usetime = $CI->config->item('cache_usetime');

		return $cache_usetime;

	}

	

	//CDN URL

	function CDN_URL(){

		$CI = & get_instance();

		$cdn_url = $CI->config->item('cdn_url');

		if($cdn_url!=""){

			return $cdn_url;

		}else{

			return base_url();

		}

	}

	

	/*修改图片路径 2014-06-10*/

	function autotofilepath($section, $arr_pic){

		$CI =& get_instance();

		

		$uploaddir = "upload/".$section;

		if (! is_dir ( $uploaddir )) {

			mkdir ( $uploaddir, 0755 );

		}

		$uploaddir = "upload/".$section."/".date('Y');

		if (! is_dir ( $uploaddir )) {

			mkdir ( $uploaddir, 0755 );

		}

		$uploaddir = "upload/".$section."/".date('Y')."/".date('m');

		if (! is_dir ( $uploaddir )) {

			mkdir ( $uploaddir, 0755 );

		}

		$arr=array();

		if(!empty($arr_pic)){

			for($i=0;$i<count($arr_pic);$i++){

				$CI->WelModel->delete_file_interim($arr_pic[$i]['value']);//删除临时文件表中信息

				$old_pic=$arr_pic[$i]['value'];

				$check_oldpic=explode('/',$old_pic);

				$ispass=1;

				if(isset($check_oldpic[1])){

					if($check_oldpic[1]==$section){

						$ispass=0;

					}

				}

				if(!empty($old_pic)&&$ispass==1){

					$old_arr=explode('.',$old_pic);

					$pic_type=end($old_arr);

					$copy_url = $uploaddir.'/'.$section.'_'.$arr_pic[$i]['num'].'_'.date('Y_m_d_H_i_s').'.'.$pic_type;

					$res=copy($old_pic, $copy_url);

					$arr[$arr_pic[$i]['item']]=$copy_url;

					//生成缩略图开始

					if(isset($arr_pic[$i]['isThumb'])&&$arr_pic[$i]['isThumb']==1){

						$copy_Thumb = $uploaddir.'/'.$section.'_'.$arr_pic[$i]['num'].'_small_'.date('Y_m_d_H_i_s').'.'.$pic_type;

						$res=copy($old_pic, $copy_Thumb);

						

						$oldpic_width=getImgWidth($old_pic);

						$oldpic_height=getImgHeight($old_pic);

						

						$scale = $arr_pic[$i]['Thumb_width']/$oldpic_width;

						resizeImage($copy_Thumb,$oldpic_width,$oldpic_height,$scale);//等比例缩放

						

						$arr[$arr_pic[$i]['Thumb_item']]=$copy_Thumb;

					}

					//生成缩略图结束

					$filename="".$old_pic;  //只能是相对路径

				    @unlink($filename);

				}

			}

		}

		return $arr;

	}

	//删除文件夹

	function file_todeldir($dir){

		$dh = opendir($dir);

		while ($file = readdir($dh)){

			if ($file != "." && $file != ".."){

				$fullpath = $dir . "/" . $file;

				if (!is_dir($fullpath)){

					unlink($fullpath);

				}else{

					file_todeldir($fullpath);

				}

			}

		}

		closedir($dh);

		if (rmdir($dir)){

			return true;

		}else{

			return false;

		}

	}

	//数据库前缀

	function DB_PRE(){

		$CI =& get_instance();

		$DB_PRE=$CI->config->item('DB_PRE');

		return $DB_PRE;

	}

	/*获取高度*/

	function getImgHeight($image) {

		$size = getimagesize($image);

		$height = $size[1];

		return $height;

	}

	

	/*获取宽度*/

	function getImgWidth($image) {

		$size = getimagesize($image);

		$width = $size[0];

		return $width;

	}

	/*获取宽度和高度*/

	function getImgWidthHeight($image) {

	    $size = getimagesize($image);

	    $width = $size[0];

	    $height = $size[1];

	    return array('width'=>$width, 'height'=>$height);

	}

	

	/*验证图片*/

	function resizeImage($image,$width,$height,$scale) {

		list($imagewidth, $imageheight, $imageType) = getimagesize($image);

		$imageType = image_type_to_mime_type($imageType);

		$newImageWidth = ceil($width * $scale);

		$newImageHeight = ceil($height * $scale);

		$newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);

		imagealphablending($newImage,false);//这里很重要,意思是不合并颜色,直接用$img图像颜色替换,包括透明色;

		imagesavealpha($newImage,true);//这里很重要,意思是不要丢了$thumb图像的透明色;

		switch($imageType) {

			case "image/gif":

				$source=imagecreatefromgif($image); 

				break;

		    case "image/pjpeg":

			case "image/jpeg":

			case "image/jpg":

				$source=imagecreatefromjpeg($image); 

				break;

		    case "image/png":

			case "image/x-png":

				$source=imagecreatefrompng($image); 

				break;

	  	}

		imagecopyresampled($newImage,$source,0,0,0,0,$newImageWidth,$newImageHeight,$width,$height);

		

		switch($imageType) {

			case "image/gif":

		  		imagegif($newImage,$image); 

				break;

	      	case "image/pjpeg":

			case "image/jpeg":

			case "image/jpg":

		  		imagejpeg($newImage,$image,90); 

				break;

			case "image/png":

			case "image/x-png":

				imagepng($newImage,$image);  

				break;

	    }

		

		chmod($image, 0755);

		return $image;

	}

	

	//判断列表的排序

	function doactionorderby($parameter){

		$contion=array('orderby');

		$parameter=explode('-',$parameter);

		$orderby='';

		$orderby_res='';

		if(!empty($parameter)){

			for($i=0;$i<count($parameter);$i++){

				for($j=0;$j<count($contion);$j++){

					if($parameter[$i]==$contion[$j]){

						$orderby=$parameter[$i+1];

						$orderby=explode('_',$orderby);

						$orderby=$orderby[1];

						$orderby_res=$parameter[$i+2];

						$orderby_res=explode('_',$orderby_res);

						$orderby_res=$orderby_res[2];

					}

				}

			}

		}

		return array('orderby'=>$orderby,'orderby_res'=>$orderby_res);

	}

	//判断列表的是否直接跳入下一节

	function doactionisnext($parameter){

		$parameter=explode('-',$parameter);

		$is_next=0;

		if(!empty($parameter)){

			for($i=0;$i<count($parameter);$i++){

				if($parameter[$i]=='next'){

					$is_next=1;

				}

			}

		}

		return $is_next;

	}

	

	/**

	 把用户输入的文本转义（主要针对特殊符号和emoji表情）

	 */

	function userTextEncode($str){

		if(!is_string($str))return $str;

		if(!$str || $str=='undefined')return '';

	

		$text = json_encode($str); //暴露出unicode

		$text = preg_replace_callback("/(\\\u[ed][0-9a-f]{3})/i",function($str){

			return addslashes($str[0]);

		},$text); //将emoji的unicode留下，其他不动，这里的正则比原答案增加了d，因为我发现我很多emoji实际上是\ud开头的，反而暂时没发现有\ue开头。

		return json_decode($text);

	}

	

	/**

	 解码上面的转义

	 */

	function userTextDecode($str){

		$text = json_encode($str); //暴露出unicode

		$text = preg_replace_callback('/\\\\\\\\/i',function($str){

			return '\\';

		},$text); //将两条斜杠变成一条，其他不动

		return json_decode($text);

	}



	//校验手机号码格式

	function isMobile($val){

		return (preg_match('/^(13|14|15|18|17)[0-9]{9}$/', $val) != 0 );

	}

	//转化成大小写，，，，search

	function actionsearchdaxiaoxiezimu($searchname, $thisname){

		if($thisname != $searchname && $searchname != ''){

			$searchname_low = strtolower($searchname);//转化为小写

			$thisname_low = strtolower($thisname);//转化为小写

		

			$thisnamezm = array();

			$thisnameisdaxie = array();

			if(mb_strlen($thisname, 'UTF8') > 0){

				for($i=0; $i< mb_strlen($thisname, 'UTF8'); $i++){

					$thisnamezm[] = mb_substr($thisname, $i, 1,'UTF-8');

						

					if(strtoupper(mb_substr($thisname, $i, 1,'UTF-8')) === mb_substr($thisname, $i, 1,'UTF-8')){

						$thisnameisdaxie[] = 1;//大写字母

					}else{

						$thisnameisdaxie[] = 0;//小写字母

					}

				}

			}

		

			$testsplit = explode($searchname_low, $thisname_low);

			if(count($testsplit) > 1){

				$thisnamelast = '';

				

				$thisname_low = str_ireplace($searchname_low,'<font style="font-weight:bold;color:red;">'.$searchname_low.'</font>', $thisname_low);

		// 		exit;

				$start_start = strpos($thisname_low, '<font');

				$start_end = strpos($thisname_low, 'ed;">');

				

				$end_start = strpos($thisname_low, '</fo');

				$end_end = strpos($thisname_low, 'nt>');

				$tt = 0;

				for($jj = 0; $jj < mb_strlen($thisname_low, 'UTF8'); $jj++){

					if($start_start >= 0){

						if($jj >= $start_start && $jj <= ($start_end + 4)){

							$thisnamelast = $thisnamelast.mb_substr($thisname_low, $jj, 1,'UTF-8');

						}else if($jj >= $end_start && $jj <= ($end_end + 2)){

							$thisnamelast = $thisnamelast.mb_substr($thisname_low, $jj, 1,'UTF-8');

						}else{

							if(isset($thisnameisdaxie[$tt]) && $thisnameisdaxie[$tt] == 1){//转化为大写

								$thisnamelast = $thisnamelast.strtoupper(mb_substr($thisname_low, $jj, 1,'UTF-8'));

							}else{//转化为小写

								$thisnamelast = $thisnamelast.strtolower(mb_substr($thisname_low, $jj, 1,'UTF-8'));

							}

							$tt++;

						}

					}else{

						if($thisnameisdaxie[$tt] == 1){//转化为大写

							$thisnamelast = $thisnamelast.strtoupper(mb_substr($thisname_low, $jj, 1,'UTF-8'));

						}else{//转化为小写

							$thisnamelast = $thisnamelast.strtolower(mb_substr($thisname_low, $jj, 1,'UTF-8'));

						}

						$tt++;

					}

				}

			}else{

				$thisnamelast = $thisname;

			}

		}else{

			$thisnamelast = str_ireplace($searchname,'<span style="color:red">'.$searchname.'</span>', $thisname);

		}

		return $thisnamelast;

	}

	

	

	//配置URL中get参数需要获取的内容

	function geturlparmersGETS(){

	    $arr = array('keyword', 'row', 'backurl', 'subbackurl', 'user_type', 'admin_type', 'group_id', 'category_id', 'language_id', 'langtype');

		return $arr;

	}

	

	function getlancodelist(){

		$arr = array();

		$arr[] = array('langtype'=>'_en', 'langfolder'=>'english', 'langname'=>'English');

		$arr[] = array('langtype'=>'_ch', 'langfolder'=>'chinese', 'langname'=>'中文');

		return $arr;

	}

	

	//获取文章的所有的图片

	function getImgs($content, $order='ALL'){

		$pattern="/<img.*?src=[\'|\"](.*?(?:[\.gif|\.jpg|\.png]))[\'|\"].*?[\/]?>/";

		preg_match_all($pattern,$content,$match);

		if(isset($match[1]) && !empty($match[1])){

			if($order==='ALL'){

				return $match[1];

			}

			if(is_numeric($order)&&isset($match[1][$order])){

				return $match[1][$order];

			}

		}

		return '';

	}

	

	/**

	 * PHP提取字符串中视频url地址

	 * @ Linyufan.com

	 * @ 2018.9.11

	 */

	function get_content_video($content, $order='ALL'){

// 	    preg_match_all("/<video[^<>]*src=[\"]([^\"]+)[\"][^<>]*>/im",$str,$matches);

// 	    return $matches[1];



	    $pattern="/<video.*?src=[\'|\"](.*?(?:[\.mp4|\.mov|\.m4v]))[\'|\"].*?[\/]?>/";

	    preg_match_all($pattern,$content,$match);

	    if(isset($match[1]) && !empty($match[1])){

	        if($order==='ALL'){

	            return $match[1];

	        }

	        if(is_numeric($order)&&isset($match[1][$order])){

	            return $match[1][$order];

	        }

	    }

	    

	    

	    $pattern="/<source.*?src=[\'|\"](.*?(?:[\.mp4|\.mov|\.m4v]))[\'|\"].*?[\/]?>/";

	    preg_match_all($pattern,$content,$match);

	    if(isset($match[1]) && !empty($match[1])){

	        if($order==='ALL'){

	            return $match[1];

	        }

	        if(is_numeric($order)&&isset($match[1][$order])){

	            return $match[1][$order];

	        }

	    }

	    

	    

	    return array();

	}

	//curl Post 数据

	function do_post_request($url, $post_Data){

		$ch = curl_init($url);

		curl_setopt($ch, CURLOPT_HEADER, 0);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		curl_setopt($ch, CURLOPT_POST, 1);

		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_Data);

		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);

		$data = curl_exec($ch);

		//		var_dump($data);

		return $data;

	}

	//将http网址转化为 https

	function urlHttpToHttps($str){

		$reparr = array();

		$reparr[] = array('name'=>"http://", 'value'=>"https://");

		$str = replace_content($reparr, $str);

	

		return $str;

	}

	

	/*

	 * 绘图文字分行函数

	 * by COoL

	 * - 输入：

	 * str: 原字符串

	 * fontFamily: 字体

	 * fontSize: 字号

	 * charset: 字符编码

	 * width: 限制每行宽度(px)

	 * - 输出：

	 * 分行后的字符串数组

	 */

	function autoLineSplit ($str, $fontFamily, $fontSize, $charset, $width) {

	    if($str != ''){

	        $result = [];

	        

	        $len = (strlen($str) + mb_strlen($str, $charset)) / 2;

	        

	        // 计算总占宽

	        $dimensions = imagettfbbox($fontSize, 0, $fontFamily, $str);

	        $textWidth = abs($dimensions[4] - $dimensions[0]);

	        

	        // 计算每个字符的长度

	        $singleW = $textWidth / $len;

	        // 计算每行最多容纳多少个字符

	        $maxCount = floor($width / $singleW);

	        

	        while ($len > $maxCount) {

	            // 成功取得一行

	            $result[] = mb_strimwidth($str, 0, $maxCount, '', $charset);

	            // 移除上一行的字符

	            $str = str_replace($result[count($result) - 1], '', $str);

	            // 重新计算长度

	            $len = (strlen($str) + mb_strlen($str, $charset)) / 2;

	        }

	        // 最后一行在循环结束时执行

	        $result[] = $str;

	        

	        return $result;

	    }else{

	        return array();

	    }

	}

	

	/**

	* php正则验证密码规则

	* 只允许 数字、字母、下划线

	* 最短1位、最长500位

	*/

	function check_SHORTURL($str) {

	    if($str != ''){

	        if (preg_match("/^[a-zA-Z0-9-]+$/", $str)){

	            return true;

	        }else {

	            exit('参数非法！');

	            return false;

	        }

	    }else{

	        return true;

	    }

	}

	

	/**

	 * 防止sql注入自定义方法一

	 * @param: mixed $value 参数值

	 * 这是因为php5.3中不再支持eregi()函数，而使用preg_match()函数替代。

	 * if(eregi('^test',$file))可以替换为if(preg_match('/^test/i',$file))

	 */

	function check_SQLinjection($value = null) {

	    #  select|insert|update|delete|\'|\/\*|\*|\.\.\/|\.\/|union|into|load_file|outfile

	    //         $str = 'select|insert|and|or|update|delete|\'|\/\*|\*|\.\.\/|\.\/|union|into|load_file|outfile';

// 	    $str = '/select|insert|update|delete|script|\'|\/\*|\*|\.\.\/|\.\/|union|into|load_file|outfile/i';

	    $str = '/select|insert|update|delete|script|\'|\/\*|\*|\.\.\/|\.\/|load_file|outfile/i';

	    if(!$value){

	        //             exit('没有参数！');

	        return true;

	    }else if(preg_match($str, $value)) {

	        exit('参数非法！');

	    }

	    return true;

	}

	/**

	 * 防止sql注入自定义方法一

	 * @param: mixed $value 参数值

	 * 这是因为php5.3中不再支持eregi()函数，而使用preg_match()函数替代。

	 * if(eregi('^test',$file))可以替换为if(preg_match('/^test/i',$file))

	 */

	function check_SQLinjection_return($value = null) {

	    if($value == '' || $value == null){

	        return '';

	    }else{

            //#  select|insert|update|delete|\'|\/\*|\*|\.\.\/|\.\/|union|into|load_file|outfile

            //         $str = 'select|insert|and|or|update|delete|\'|\/\*|\*|\.\.\/|\.\/|union|into|load_file|outfile';

            // 	    $str = '/select|insert|update|delete|script|\'|\/\*|\*|\.\.\/|\.\/|union|into|load_file|outfile/i';

            

	        //正确的

// 	        $str = '/select|insert|update|delete|script|\'|\/\*|\*|\.\.\/|\.\/|load_file|outfile/i';

	        $str = '/insert|left join|script|\'|\/\*|\*|\.\.\/|\.\/|load_file|outfile/i';

	        if(!$value){

                //exit('没有参数！');

                return '';

            }else if(preg_match($str, $value)) {

                return '参数非法！';

            }else{

                return '';

            }

	    }

	    

	}

	/**

	 */

	function check_NUMBERinjection($value = 0) {

	    check_SHORTURL($value);

	    if($value != '' && $value != 0){

	        if(is_numeric($value)){

	            if($value < 0){

	                exit('参数非法！');

	            }

	        }else{

	            exit('参数非法！');

	        }

	    }

	    return true;

	}

	/**

	 */

	function check_NUMBERphone($value = 0) {

	    if($value != '' && $value != 0){

	        if(is_numeric($value)){

	            if(mb_strlen($value, 'UTF-8') == 11){

	                

	            }else{

	                exit('参数非法！');

	            }

	        }else{

	            exit('参数非法！');

	        }

	    }

	    return true;

	}

	//检查token格式

	function check_TOKENformat($api_token){

	    if($api_token != ''){

	        if(ctype_alnum($api_token)){//所有的字符全部是字母和(或者)数字

	            if(mb_strlen($api_token) == 32 || mb_strlen($api_token) == 16 || mb_strlen($api_token) == 8){//长度必须为32位数

	                

	            }else{

	                exit('参数非法！');

	            }

	        }else{

	            exit('参数非法！');

	        }

	    }

	}

	

	function GetIP(){

	    if(!empty($_SERVER["HTTP_CLIENT_IP"])){

	        $cip = $_SERVER["HTTP_CLIENT_IP"];

	    }elseif(!empty($_SERVER["HTTP_X_FORWARDED_FOR"])){

	        $cip = $_SERVER["HTTP_X_FORWARDED_FOR"];

	    }elseif(!empty($_SERVER["REMOTE_ADDR"])){

	        $cip = $_SERVER["REMOTE_ADDR"];

	    }else{

	        $cip = "127.0.0.1";

	    }

	    if($cip == '::1'){

	        $cip = "127.0.0.1";

	    }

	    return $cip;

	}

	

	function clear_p_label($content){

	    $content = str_replace('<p>', '', $content);

	    $content = str_replace('</p>', '', $content);

	    $content = str_replace('/wordpressnostress', '', $content);

	    return $content;

	}

	

	
// lang retrun helper 
	function s_lang(){
		$CI =& get_instance();

        $CI->load->database();

        

        $current_language = $CI->session->userdata('controller_name');
		if($current_language == ''){
                 $current_language = 'en';
		}

		   
	    return $current_language ;
	}

	