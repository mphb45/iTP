<form name="rosis" action="index.php?toload=rosis_new" method="post" >

<?php

if (isset($_POST[submit])) {

	$_POST[Date_discovery]=mktime($_POST[h], $_POST[minute], 0, $_POST[mois], $_POST[jour], $_POST[annee]);
	$_POST[Time_discovery]=$_POST[h].":".$_POST[minute];
	$temps=time();
	
	//texte a protéger pour le SQL
	
	$severity_comment = mysql_real_escape_string($_POST[severity_comment]);
	$Potential_comment = mysql_real_escape_string($_POST[Potential_comment]);
	$short_descr = mysql_real_escape_string($_POST[short_descr]);
	$hardware = mysql_real_escape_string($_POST[hardware]);
	$description = mysql_real_escape_string($_POST[description]);
	$cause = mysql_real_escape_string($_POST[cause]);
	$suggestion = mysql_real_escape_string($_POST[suggestion]);
	$Nom_Rapporteur = mysql_real_escape_string($_POST[Nom_Rapporteur]);
	$Nom_pers_concernee = mysql_real_escape_string($_POST[Nom_pers_concernee]);
	$qa_disc_other_descr = mysql_real_escape_string($_POST[qa_disc_other_descr]);
	$Nom_patient_concerne = mysql_real_escape_string($_POST[Nom_patient_concerne]);
	
	
	
	$sqlinsert="INSERT INTO rosis(date_report, Nom_Rapporteur, Nom_pers_concernee, Nom_patient_concerne, 
		Modality, Date_discovery, Time_discovery,
		staff_disc_onc, staff_disc_phys, staff_disc_rad_ther_treat, staff_disc_rad_ther_sim, staff_disc_dos,
		qa_disc_chart_check, weekly_chart_check, qa_disc_in_vivo, qa_disc_port_film, qa_disc_clin_rev, qa_disc_QA_eq,
		qa_disc_at_1st_tx, qa_disc_later_tx, qa_disc_ext_audit, dqa_tomo, qa_disc_other, qa_disc_other_descr,
		Process, aff_several, aff_number, aff_one, aff_nonpatient, aff_none,
		Treatment_given, Erreneous_fractions, Number_fractions, Number_fractions_tobedone,
		severity, severity_comment, Potential, Potential_comment,
		short_descr, hardware, description, cause, suggestion, Envoyer
		)
	
	VALUES('$temps', '$Nom_Rapporteur', '$Nom_pers_concernee', '$Nom_patient_concerne',
		'$_POST[Modality]', '$_POST[Date_discovery]', '$_POST[Time_discovery]',
		'$_POST[staff_disc_onc]', '$_POST[staff_disc_phys]', '$_POST[staff_disc_rad_ther_treat]', '$_POST[staff_disc_rad_ther_sim]', '$_POST[staff_disc_dos]',
		'$_POST[qa_disc_chart_check]','$_POST[weekly_chart_check]','$_POST[qa_disc_in_vivo]','$_POST[qa_disc_port_film]',
		'$_POST[qa_disc_clin_rev]','$_POST[qa_disc_QA_eq]','$_POST[qa_disc_at_1st_tx]','$_POST[qa_disc_later_tx]',
		'$_POST[qa_disc_ext_audit]','$_POST[dqa_tomo]','$_POST[qa_disc_other]','$qa_disc_other_descr',
		'$_POST[Process]','$_POST[aff_several]','$_POST[aff_number]','$_POST[aff_one]','$_POST[aff_nonpatient]','$_POST[aff_none]',
		'$_POST[Treatment_given]', '$_POST[Erreneous_fractions]', '$_POST[Number_fractions]', '$_POST[Number_fractions_tobedone]', 
		'$_POST[severity]', '$severity_comment', '$_POST[Potential]', '$Potential_comment', 
		'$short_descr', '$hardware', '$description', '$cause', '$suggestion', '$_POST[Envoyer]'
		)";
	myquery($sqlinsert);
    die("<META HTTP-equiv='refresh' content='0;URL=index.php?toload=rosis_new'>"); 
    echo "Votre rapport Rosis a été correctement enregistré";

}
?>	
<h4><font size="5">Rapport d&rsquo;incidence</font></h4>
<p><font size="5"><font color="#FF0000" size="1"> (aucun champ n'est obligatoire) </font></font></p>
<p><b>Type de traitement o&ugrave; l&rsquo;incident s&rsquo;est produit/ a &eacute;t&eacute; d&eacute;couvert/ pourrait se produire </b></p>
<p>
  <input name="Modality" value="EBR" type="radio" <?php if ($_POST['Modality']=="EBR") {echo "checked" ;} ?> >
  Radioth&eacute;rapie externe </p>
<p>
  <input name="Modality" value="BT" type="radio" <?php if ($_POST['Modality']=="BT") {echo "checked" ;} ?> >
  Curieth&eacute;rapie </p>
<p>
  <input name="Modality" value="Other" type="radio">
  TBI&nbsp;&nbsp;</p>
<hr>
<h4>Date de la découverte:</h4>
<p>(Entrer la date sous la forme JJ/MM/AAAA):&nbsp; &nbsp;
    
    <select name="jour" >
      <option value="<? echo $_POST[jour];?>"> <? echo $_POST[jour];?>
	  <?php 
	  for ($j=1; $j<32; $j++) {
	  ?>
	  <option value="<?php echo $j; ?>"><?php echo $j; ?>
	  <?php } ?>
    </select>
    <b><font color="#FF0000">  </font></b>/
    <select name="mois" >
      <option value="<? echo $_POST[mois];?>"> <? echo $_POST[mois];?>
      <?php 
	  for ($m=1; $m<13; $m++) {
	  ?>
	  <option value="<?php echo $m; ?>"><?php echo $m; ?>
	  <?php } ?>
    </select>
    <b><font color="#FF0000">  </font></b> /
    <select name="annee" >
      <option value="<? echo $_POST[annee];?>"> <? echo $_POST[annee];?>
      <?php 
	  $annee=date("Y")-1;
	  for ($a=$annee; $a<$annee+3; $a++) {?>
	  <option value="<?php echo $a;?>"><?php echo $a;?>
	  <?php } ?>
    </select>
  </p>
<p>(Entrer l&rsquo;heure sous la forme XX&nbsp;h XX)&nbsp;: &nbsp;
  
  <select name="h" >
    <option value="<? echo $_POST[h];?>"> <? echo $_POST[h];?>
     <?php 
	  for ($h=1; $h<25; $h++) {
	  ?>
	  <option value="<?php echo $h; ?>"><?php echo $h; ?>
	  <?php } ?>
    </select>
  h <b><font color="#FF0000">  </font></b>
  <select name="minute" >
    <option value="<? echo $_POST[minute];?>"> <? echo $_POST[minute];?>
      <?php 
	  for ($minute=0; $minute<60; $minute=$minute+5) {
	  ?>
	  <option value="<?php echo $minute; ?>"><?php echo $minute; ?>
	  <?php } ?>
    </select>
 </p>
<hr>
<h4>Qui a d&eacute;couvert l&rsquo;incident ? </h4>
<p>Cocher la case ad&eacute;quate:</p>
<p>
  <input value="ON" name="staff_disc_onc" type="checkbox">
  Radioth&eacute;rapeute</p>
<p>
  <input value="ON" name="staff_disc_phys" type="checkbox">
  Physicien m&eacute;dical </p>
<p>
  <input value="ON" name="staff_disc_rad_ther_treat" type="checkbox">
  Infirmi&egrave;re / Technologue </p>
<p>
  <input value="ON" name="staff_disc_rad_ther_sim" type="checkbox">
  Dosim&eacute;triste </p>
<p>
  <input value="ON" name="staff_disc_dos" type="checkbox">
  Ing&eacute;nieur / Technicien </p>
<hr>
<h4>Comment l&rsquo;incident a-t-il &eacute;t&eacute; d&eacute;couvert? </h4>
<p>Cocher la case ad&eacute;quate:</p>
<p>
  <input value="ON" name="qa_disc_chart_check" type="checkbox">
  V&eacute;rification de la carte </p>
<p>
  <input value="ON" name="weekly_chart_check" type="checkbox">
R&eacute;vision hebdomadaire des cartes </p>
<p>
  <input value="ON" name="qa_disc_in_vivo" type="checkbox">
  Dosim&eacute;trie in-vivo </p>
<p>
  <input value="ON" name="qa_disc_port_film" type="checkbox">
  Image portale (film radiographique et/ou EPID) </p>
<p>
  <input value="ON" name="qa_disc_clin_rev" type="checkbox">
  Consultation hebdomadaire du patient </p>
<p>
  <input value="ON" name="qa_disc_QA_eq" type="checkbox">
  Contr&ocirc;le de qualit&eacute; de l&rsquo;&eacute;quipement </p>
<p>
  <input value="ON" name="qa_disc_at_1st_tx" type="checkbox">
  Lors du placement du 1er jour de traitement du patient </p>
<p>
  <input value="ON" name="qa_disc_later_tx" type="checkbox">
  En cours de traitement </p>
<p>
  <input value="ON" name="qa_disc_ext_audit" type="checkbox">
  Audit externe </p>
<p>
  <input value="ON" name="dqa_tomo" type="checkbox">
Lors du DQA Tomo du patient </p>
<p>
  <input value="ON" name="qa_disc_other" type="checkbox">
  Autre (&agrave; pr&eacute;ciser):
<input size="63" name="qa_disc_other_descr">
</p>
<hr>
<h4>A quelle &eacute;tape l&rsquo;incident a-t-il &eacute;t&eacute; d&eacute;couvert ? </h4>
<p>Choisissez la case la plus appropri&eacute;e. </p>
<p>
  <input name="Process" value="pretreatment" type="radio">
  Pr&eacute;traitement (i.e.. CT, simulateur, planning) </p>
<p>
  <input name="Process" value="treatment" type="radio">
  Traitement </p>
<p>
  <input name="Process" value="follow-up" type="radio">
  Follow-up </p>
<p>
  <input name="Process" value="Non patient specific" type="radio">
  Etape en dehors de la fili&egrave;re patient</p>
<hr>
<h4>L&rsquo;incident a-t-il affect&eacute; une personne ? </h4>
<p>Cocher la case la plus appropri&eacute;e:</p>
<p>
  <input value="ON" name="aff_several" type="checkbox">
  Oui, plusieurs patients, nombre de patients affect&eacute;s
<input name="aff_number" size="8" type="text">
</p>
<p>
  <input value="ON" name="aff_one" type="checkbox">
  Oui, un patient </p>
<p>
  <input value="ON" name="aff_nonpatient" type="checkbox">
  Oui, le personnel ou toute autre personne </p>
<p>
  <input value="ON" name="aff_none" type="checkbox">
  Non, (mais une personne aurait pu &ecirc;tre affect&eacute;e) </p>
<hr>
<p><b>Un traitement a-t-il &eacute;t&eacute; d&eacute;livr&eacute; de fa&ccedil;on incorrecte ? </b></p>
<p>&nbsp;
    <input name="Treatment_given" value="Yes" type="radio">
    Oui&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input name="Treatment_given" value="No" type="radio">
    Non</p>
<p> Si OUI, combien de fractions incorrectes  ?&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;
    <input name="Erreneous_fractions" size="5" type="text">
</p>
<p>Nombre total de fractions prescrites&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
    <input name="Number_fractions" size="5" type="text">
</p>
<p>Nombre de fractions restantes lors de l&rsquo;incident&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; 
  <input name="Number_fractions_tobedone" size="5" type="text">
</p>
<hr>
<h4> Impacts  pour le(s) patient(s) / personnel affect&eacute;s </h4>
<p>
  <input name="severity" value="None" type="radio">
  Aucun</p>
<p>
  <input name="severity" value="Light" type="radio">
  L&eacute;gers (i.e. correction possible) </p>
<p>
  <input name="severity" value="Moderate" type="radio">
  Mod&eacute;r&eacute;s (certaines complications ne sont pas exclues)</p>
<p>
  <input name="severity" value="High" type="radio">
  Elev&eacute;s (complications cliniques tr&egrave;s probables) </p>
<p>
  <input name="severity" value="Severe" type="radio">
  S&eacute;v&egrave;res (probabilit&eacute; &eacute;lev&eacute;e de complications cliniques s&eacute;v&egrave;res) </p>
<p>Commentaires sur la s&eacute;v&eacute;rit&eacute; des complications :&nbsp; </p>
<p>
  <textarea rows="5" name="severity_comment" cols="50"></textarea>
</p>
<hr>
<h4> Impacts probables pour le(s) patient(s) / personnel affect&eacute;s si l&rsquo;incident n&rsquo;avait pas &eacute;t&eacute; d&eacute;tect&eacute; et/ou corrig&eacute;&nbsp;: </h4>
<p>
  <input name="Potential" value="None" type="radio">
  Aucun</p>
<p>
  <input name="Potential" value="Light" type="radio">
  L&eacute;gers (i.e. correction possible) </p>
<p>
  <input name="Potential" value="Moderate" type="radio">
 Mod&eacute;r&eacute;s (certaines complications ne sont pas exclues)</p>
<p>
  <input name="Potential" value="High" type="radio">
  Elev&eacute;s (complications cliniques tr&egrave;s probables) </p>
<p>
  <input name="Potential" value="Severe" type="radio">
  S&eacute;v&egrave;res (probabilit&eacute; &eacute;lev&eacute;e de complications cliniques s&eacute;v&egrave;res) </p>
<p>Commentaires sur la s&eacute;v&eacute;rit&eacute; des complications probables :&nbsp; </p>
<p>
  <textarea rows="5" name="Potential_comment" cols="50"></textarea>
</p>
<hr>
<h4>R&eacute;sumer l&rsquo;incident en une seule phrase&nbsp;: </h4>
<p>
  <textarea rows="2" name="short_descr" cols="50"></textarea>
</p>
<h4> Si la cause de l&rsquo;incident est li&eacute;e &agrave; un &eacute;quipement , sp&eacute;cifier le type, la marque et le mod&egrave;le de l&rsquo;&eacute;quipement ainsi que la version utilis&eacute;e (si software). </h4>
<p>
  <textarea rows="5" name="hardware" cols="50"></textarea>
</p>
<h4>Description de l&rsquo;incident </h4>
<p>
  <textarea rows="11" name="description" cols="50"></textarea>
</p>
<h4>Cause de l&rsquo;incident (d&rsquo;apr&egrave;s votre avis) </h4>
<p>
  <textarea rows="5" name="cause" cols="50"></textarea>
</p>
<h4>Suggestions pour actions pr&eacute;ventives </h4>
<p>
  <textarea rows="5" name="suggestion" cols="50"></textarea>
</p>
<hr>
<p>Nom du rapporteur
  <input name="Nom_Rapporteur" size="25" maxsize="50" type="text" value="<?php echo $_POST['Nom_Rapporteur']; ?>">
</p>
<p>Nom de la personne concern&eacute;e par l'incident
    <input name="Nom_pers_concernee" size="25" maxsize="50" type="text" value="<?php echo $_POST['Nom_pers_concernee']; ?>">
</p>
<p>N&deg; d'administration de la personne concern&eacute;e par l'incident
    <input name="Nom_patient_concerne" size="25" maxsize="50" type="text" value="<?php echo $_POST['Nom_patient_concerne']; ?>">
</p>
<hr>
<p><br>
  <input type="submit" border="0" name="submit" value="Enregistrer" class="bouton">
</p>
</form>