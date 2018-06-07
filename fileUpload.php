<div class="row">
							<div class="col-lg-12">
								<table width="100%">											
									<tr>
										<td width="20%" valign="center">
											Upload Document
										</td>
										<td valign="center">
											<form>
												<div class="input-group">
													<span class="input-group-btn">
														<span class="btn btn-primary btn-file" style="position: relative;  overflow: hidden;">
															Browse&hellip; <input type="file" name="uploadFile" onChange="submitRev();" style="position: absolute; top: 0; right: 0;  min-width: 100%; min-height: 100%; font-size: 100px; text-align: right; filter: alpha(opacity=0); opacity: 0; background: red; cursor: inherit; display: block;">
														</span>
													</span>
													<input type="text" id="fileupx" name="fileupx" value="<?php echo $docu;?>" class="form-control" style="background-color: white !important;cursor: text !important;" readonly />
													<input type="hidden" value="upload"	id="uploadbtn" name="uploadbtn" onClick="fileUpload(this.form,'test.php','upload'); return false;" >
														<div id="upload"></div>
												</div>
											</form>
										</td>		                                         
									</tr>
								</table>
							</div>							
						</div>