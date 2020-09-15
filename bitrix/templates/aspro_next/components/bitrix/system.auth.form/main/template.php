<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

Aspro\Next\PhoneAuth::modifyResult($arResult, $arParams);

if($arResult['PHONE_AUTH_PARAMS']['USE']){
	echo CJSCore::Init('phone_auth', true);
}
?>
<?/*<link rel="stylesheet" type="text/css" href="/bitrix/js/socialservices/css/ss.css">*/?>
<?if($arResult["FORM_TYPE"] === "login"):?>
	<div id="ajax_auth">
		<?if($arResult["ERROR"]):?>
			<div class="alert alert-danger"><?=$arResult['ERROR_MESSAGE']['MESSAGE']?></div>
		<?elseif($arResult['SHOW_SMS_FIELD']):?>
			<div class="alert alert-success"><?=GetMessage('main_user_auth_code_sent')?></div>
		<?endif;?>
		<div class="auth_wrapp form-block">
			<div class="wrap_md1">
				<?if($arResult['PHONE_AUTH_PARAMS']['USE']):?>
					<div class="auth_select_title"><?=GetMessage("AUTH_SELECT")?></div>
					<?if($arParams['POPUP_AUTH'] !== 'Y'):?>
						<br />
					<?endif;?>
					<div class="tabs">
						<ul class="nav nav-tabs">
							<li class="<?=($arResult['PHONE_REQUEST'] ? '' : 'active')?>"><a href="#auth_by_login" data-toggle="tab"><?=GetMessage('AUTH_BY_LOGIN_OR_EMAIL')?></a></li>
							<li class="<?=($arResult['PHONE_REQUEST'] ? 'active' : '')?>"><a href="#auth_by_phone" data-toggle="tab"><?=GetMessage('AUTH_BY_PHONE')?></a></li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane <?=($arResult['PHONE_REQUEST'] ? '' : 'active')?>" id="auth_by_login">
				<?endif;?>
				<div class="main_info_block form">
					<div class="form-wr form-body">
						<form id="avtorization-form" name="system_auth_form<?=$arResult["RND"]?>" method="post" target="_top" action="<?=$arParams["AUTH_URL"]?>?login=yes">
							<?if($arResult["BACKURL"] <> ''):?>
								<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
							<?endif;?>
							<?foreach($arResult["POST"] as $key => $value):?>
								<?if($key !== 'captcha_word'):?>
									<input type="hidden" name="<?=$key?>" value="<?=$value?>" />
								<?endif;?>
							<?endforeach;?>
							<input type="hidden" name="AUTH_FORM" value="Y" />
							<input type="hidden" name="TYPE" value="AUTH" />
							<input type="hidden" name="POPUP_AUTH" value="<?=$arParams['POPUP_AUTH']?>" />

							<div class="row" data-sid="USER_LOGIN_POPUP">
								<div class="form-group animated-labels input-filed">
									<div class="col-md-12">
										<label for="USER_LOGIN_POPUP"><?=GetMessage("AUTH_LOGIN")?> <span class="required-star">*</span></label>
										<div class="input">
											<input type="text" name="USER_LOGIN" id="USER_LOGIN_POPUP" class="form-control required" maxlength="50" value="<?=$arResult["USER_LOGIN"]?>" autocomplete="on" tabindex="1"/>
										</div>
									</div>
								</div>
							</div>
							<div class="row" data-sid="USER_PASSWORD_POPUP">
								<div class="form-group animated-labels input-filed">
									<div class="col-md-12">
										<label for="USER_PASSWORD_POPUP"><?=GetMessage("AUTH_PASSWORD")?> <span class="required-star">*</span></label>
										<div class="input">
											<input type="password" name="USER_PASSWORD" id="USER_PASSWORD_POPUP" class="form-control required password" maxlength="50" value="" autocomplete="on" tabindex="2"/>
										</div>
									</div>
								</div>
							</div>
							<?if($arResult["CAPTCHA_CODE"] && $arResult['ONLY_PHONE_CAPTCHA'] !== 'Y'):?>
								<div class="form-control bg register-captcha captcha-row clearfix">
									<label><span><?=GetMessage("AUTH_CAPTCHA_PROMT")?>&nbsp;<span class="star">*</span></span></label>
									<div class="captcha_image">
										<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" border="0" />
										<input type="hidden" name="captcha_sid" class="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />
										<div class="captcha_reload"><?=GetMessage("REFRESH")?></div>
									</div>
									<div class="captcha_input">
										<input type="text" class="inputtext captcha" name="captcha_word" id="captcha_word" size="30" maxlength="50" value="" required />
									</div>
								</div>
							<?endif;?>
							<div class="but-r">
								<div class="filter block">
									<a class="forgot pull-right" href="<?=$arResult["AUTH_FORGOT_PASSWORD_URL"]?>" tabindex="3"><?=GetMessage("AUTH_FORGOT_PASSWORD_2")?></a>
									<div class="prompt remember pull-left">
										<input type="checkbox" id="USER_REMEMBER_frm" name="USER_REMEMBER" value="Y" tabindex="5"/>
										<label for="USER_REMEMBER_frm" title="<?=GetMessage("AUTH_REMEMBER_ME")?>" tabindex="5"><?=GetMessage("AUTH_REMEMBER_SHORT")?></label>
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="buttons clearfix">
									<input type="submit" class="btn btn-default bold" name="Login" value="<?=GetMessage("AUTH_LOGIN_BUTTON")?>" tabindex="4" />
								</div>
							</div>
						</form>
					</div>
				</div>
				<?if($arResult['PHONE_AUTH_PARAMS']['USE']):?>
							</div>
							<div class="tab-pane <?=($arResult['PHONE_REQUEST'] ? 'active' : '')?>" id="auth_by_phone">
								<div class="main_info_block form">
									<div class="form-wr form-body">
										<form id="avtorization-form2" name="system_auth_form<?=$arResult["RND"]?>2" method="post" target="_top" action="<?=$arParams["AUTH_URL"]?>?login=yes">
											<?if($arResult["BACKURL"] <> ''):?>
												<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
											<?endif;?>
											<?foreach($arResult["POST"] as $key => $value):?>
												<input type="hidden" name="<?=$key?>" value="<?=$value?>" />
											<?endforeach;?>
											<input type="hidden" name="AUTH_FORM" value="Y" />
											<input type="hidden" name="POPUP_AUTH" value="<?=htmlspecialcharsbx($arParams['POPUP_AUTH'])?>" />

											<?if($arResult['SHOW_SMS_FIELD']):?>
												<input type="hidden" name="USER_PHONE_NUMBER" value="<?=htmlspecialcharsbx($arResult['USER_PHONE_NUMBER'])?>" />
												<input type="hidden" name="SIGNED_DATA" value="<?=htmlspecialcharsbx($arResult["SIGNED_DATA"])?>" />
												<div class="row" data-sid="SMS_CODE_POPUP">
													<div class="form-group animated-labels input-filed">
														<div class="col-md-12">
															<label for="SMS_CODE_POPUP"><?=GetMessage("AUTH_FIELD_SMS_CODE")?> <span class="required-star">*</span></label>
															<div class="input">
																<input type="text" name="SMS_CODE" id="SMS_CODE_POPUP" class="form-control" maxlength="50" value="<?=htmlspecialcharsbx($arResult['SMS_CODE'])?>" autocomplete="off" tabindex="1" required />
															</div>
														</div>
													</div>
												</div>
												<?if($arResult["CAPTCHA_CODE"]):?>
													<div class="form-control bg register-captcha captcha-row clearfix">
														<label><span><?=GetMessage("AUTH_CAPTCHA_PROMT")?>&nbsp;<span class="star">*</span></span></label>
														<div class="captcha_image">
															<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" border="0" />
															<input type="hidden" name="captcha_sid" class="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />
															<div class="captcha_reload"><?=GetMessage("REFRESH")?></div>
														</div>
														<div class="captcha_input">
															<input type="text" class="inputtext captcha" name="captcha_word" id="captcha_word" size="30" maxlength="50" value="" required />
														</div>
													</div>
												<?endif;?>
												<div class="but-r">
													<div class="filter block">
														<div class="prompt remember pull-left">
															<input type="checkbox" id="USER_REMEMBER_frm2" name="USER_REMEMBER" value="Y" tabindex="5"/>
															<label for="USER_REMEMBER_frm2" title="<?=GetMessage("AUTH_REMEMBER_ME")?>" tabindex="5"><?=GetMessage("AUTH_REMEMBER_SHORT")?></label>
														</div>
														<div class="clearfix"></div>
													</div>
													<div class="buttons clearfix">
														<input type="submit" class="btn btn-default bold" name="Login" value="<?=GetMessage("main_auth_sms_send")?>" tabindex="4" />
													</div>
												</div>
											<?else:?>
												<div class="row" data-sid="USER_PHONE_NUMBER_POPUP">
													<div class="form-group animated-labels input-filed">
														<div class="col-md-12">
															<label for="USER_PHONE_NUMBER_POPUP"><?=GetMessage("auth_phone_number")?> <span class="required-star">*</span></label>
															<div class="input">
																<input type="tel" name="USER_PHONE_NUMBER" id="USER_PHONE_NUMBER_POPUP" class="form-control phone" maxlength="50" value="<?=htmlspecialcharsbx($arResult['USER_PHONE_NUMBER'])?>" autocomplete="on" tabindex="1" required />
															</div>
														</div>
													</div>
												</div>
												<?if($arResult["CAPTCHA_CODE"]):?>
													<div class="form-control bg register-captcha captcha-row clearfix">
														<label><span><?=GetMessage("AUTH_CAPTCHA_PROMT")?>&nbsp;<span class="star">*</span></span></label>
														<div class="captcha_image">
															<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" border="0" />
															<input type="hidden" name="captcha_sid" class="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />
															<div class="captcha_reload"><?=GetMessage("REFRESH")?></div>
														</div>
														<div class="captcha_input">
															<input type="text" class="inputtext captcha" name="captcha_word" id="captcha_word" size="30" maxlength="50" value="" required />
														</div>
													</div>
												<?endif;?>
												<div class="but-r">
													<div class="buttons clearfix" style="margin-top:0;">
														<input type="submit" class="btn btn-default bold" name="Login" value="<?=GetMessage("AUTH_GET_SMS_CODE")?>" tabindex="4" />
													</div>
												</div>
											<?endif;?>
										</form>
										<?if($arResult['SHOW_SMS_FIELD']):?>
											<?$rand = rand(1, 99);?>
											<div id="bx_auth_error<?=$rand?>" style="display:none"><?ShowError("error")?></div>
											<div id="bx_auth_resend<?=$rand?>"></div>
											<script>
											new BX.PhoneAuth({
												containerId: 'bx_auth_resend<?=$rand?>',
												errorContainerId: 'bx_auth_error<?=$rand?>',
												interval: <?=$arResult["PHONE_CODE_RESEND_INTERVAL"]?>,
												data:
													<?=CUtil::PhpToJSObject([
														'signedData' => $arResult["SIGNED_DATA"],
													])?>,
												onError:
													function(response)
													{
														var errorDiv = BX('bx_auth_error<?=$rand?>');
														var errorNode = BX.findChildByClassName(errorDiv, 'errortext');
														errorNode.innerHTML = '';
														for(var i = 0; i < response.errors.length; i++)
														{
															errorNode.innerHTML = errorNode.innerHTML + BX.util.htmlspecialchars(response.errors[i].message) + '<br>';
														}
														errorDiv.style.display = '';
													}
											});
											</script>
										<?endif;?>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?endif;?>
			</div>
			<?if($arResult["AUTH_SERVICES"]):?>
				<div class="reg-new">
					<div class="soc-avt">
						<div class="title"><?=GetMessage("SOCSERV_AS_USER_FORM");?></div>
						<?$APPLICATION->IncludeComponent("bitrix:socserv.auth.form", "icons",
							array(
								"AUTH_SERVICES" => $arResult["AUTH_SERVICES"],
								"AUTH_URL" => SITE_DIR."auth/?login=yes",
								"POST" => $arResult["POST"],
								"SUFFIX" => "form",
							),
							$component, array("HIDE_ICONS"=>"Y")
						);
						?>
					</div>
				</div>
			<?endif;?>
			<div class="form-footer socserv1">
				<div class="inner-table-block">
				<!--noindex--><a href="<?=$arResult["AUTH_REGISTER_URL"];?>" rel="nofollow" class="btn transparent bold register" tabindex="6"><?=GetMessage("AUTH_REGISTER_NEW")?></a><!--/noindex-->
				</div>
				<div class="inner-table-block">
					<div class="more_text_small">
						<?$APPLICATION->IncludeFile(SITE_DIR."include/top_auth.php", Array(), Array("MODE" => "html", "NAME" => GetMessage("TOP_AUTH_REGISTER")));?>
					</div>
				</div>
			</div>
		</div>
		<script>
		function initValidate($form){
			if($form.length){
				$form.validate({
					rules: {
						USER_LOGIN: {
							required: true
						}
					},
					submitHandler: function(form){
						if($(form).valid()){
							/*var eventdata = {type: 'form_submit', form: form, form_name: 'AUTH'};
							BX.onCustomEvent('onSubmitForm', [eventdata]);*/

							jsAjaxUtil.CloseLocalWaitWindow('id', 'wrap_ajax_auth');
							jsAjaxUtil.ShowLocalWaitWindow('id', 'wrap_ajax_auth', true);

							var bCaptchaInvisible = false;
							if(window.renderRecaptchaById && window.asproRecaptcha && window.asproRecaptcha.key)
							{
								if(window.asproRecaptcha.params.recaptchaSize == 'invisible' && $(form).find('.g-recaptcha').length)
								{
									if(!$(form).find('.g-recaptcha-response').val())
									{
										if(typeof grecaptcha != 'undefined'){
											// there need to remove the second recaptcha on sibligs form
											$(form).closest('.tab-pane').siblings().find('.g-recaptcha').remove();

											bCaptchaInvisible = true;
											grecaptcha.execute($(form).find('.g-recaptcha').data('widgetid'));
										}
									}
								}
							}

							if(!bCaptchaInvisible)
							{
								var $button = $(form).find('input[type=submit]');
								if($button.length){
									if(!$button.hasClass('loadings')){
		  								$button.addClass('loadings');

										$.ajax({
											type: "POST",
											url: $(form).attr('action'),
											data: $(form).serializeArray()
										}).done(function(html){
											if($(html).find('.alert').length){
												$('#ajax_auth').parent().html(html);
											}
											else{
												BX.reload(false);
											}

											jsAjaxUtil.CloseLocalWaitWindow('id', 'wrap_ajax_auth');
										});
									}
								}
							}
						}
					},
					errorPlacement: function(error, element){
						$(error).attr('alt', $(error).text());
						$(error).attr('title', $(error).text());
						error.insertBefore(element);
					}
				});

				if(arNextOptions['THEME']['PHONE_MASK'].length){
					var base_mask = arNextOptions['THEME']['PHONE_MASK'].replace( /(\d)/g, '_' );
					$form.find('input.phone').inputmask('mask', {'mask': arNextOptions['THEME']['PHONE_MASK'] });
					$form.find('input.phone').blur(function(){
						if($(this).val() == base_mask || $(this).val() == ''){
							if($(this).hasClass('required')){
								$(this).parent().find('label.error').html(BX.message('JS_REQUIRED'));
							}
						}
					});
				}
			}
		}

		$(document).ready(function(){
			$('form[name=bx_auth_servicesform]').validate();
			$('.auth_wrapp .form-body a').removeAttr('onclick');

			if($('#ajax_auth .nav-tabs>li').length){
				$('#ajax_auth .nav-tabs>li').click(function(){
					var id = $(this).find('>a').attr('href');
					if(id.length){
						var $tabContent = $(id);
						if($tabContent.length){
							var $form = $tabContent.find('form')
							if($form.length){
								if(!$(this).hasClass('inited')){
									$(this).addClass('inited');
									initValidate($form);
								}

								setTimeout(function(){
									$form.find('input:visible').eq(0).focus();
								}, 50);
							}
						}
					}
				});

				$('#ajax_auth .nav-tabs>li.active').trigger('click');
			}
			else{
				initValidate($('#avtorization-form'));

				setTimeout(function(){
					$('#avtorization-form').find('input:visible').eq(0).focus();
				}, 50);
			}
		});
		</script>
	</div>
<?else:?>
	<script>
	BX.reload(true);
	</script>
<?endif;?>