{$modules.head}

	<!-- This is an HTML comment -->
	{* This is a Smarty comment *}

<FORM method=post action="cgi-bin/script.pl">
	<h2>Registre d'un instrument</h2>
	<TABLE BORDER=4>
		<TR>
			<TD class="titol_registre">Nom de l'instrument:</TD>
			<TD>
				<INPUT type=text name="nom_instrument">
			</TD>
		</TR>

		<TR>
			<TD class="titol_registre" >Tipus instrument:</TD>
			<TD>
				<INPUT type=text name="tipus_instrument">
			</TD>
		</TR>

		<TR>
			<TD class="titol_registre">URL:</TD>
			<TD>
				<INPUT type=text name="url_foto">
			</TD>
		</TR>

		<TR>
			<TD COLSPAN=2 class="send_button">
				<INPUT type="submit" value="Enviar">
			</TD>
		</TR>
	</TABLE>
</FORM>

{$modules.footer}