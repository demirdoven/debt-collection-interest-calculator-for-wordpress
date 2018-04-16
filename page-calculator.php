<?php
/**
 * The template used for displaying page content
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
		// Post thumbnail.
		twentyfifteen_post_thumbnail();
	?>

	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		
	  <form name="form1" id="form1" action="" method="post">
		
		<label style="float:left; width: 150px;">Jurisdiction</label>
		<select style="width: 200px;height:35px; border: 1px solid rgba(51, 51, 51, 0.1);color: rgba(51, 51, 51, 0.7);padding-left: 0.3em;" name="rulee" id="rulee" class="rulee">
			<option <?php if( $_POST['rulee']==1 ){ echo 'selected="selected"'; } ?> value="1">Rule 1</option>
			<option <?php if( $_POST['rulee']==2 ){ echo 'selected="selected"'; } ?> value="2">Rule 2</option>
			<option <?php if( $_POST['rulee']==3 ){ echo 'selected="selected"'; } ?> value="3">Rule 3</option>
			<option <?php if( $_POST['rulee']==4 ){ echo 'selected="selected"'; } ?> value="4">Rule 4</option>
		</select>
		
		</br>
		
		<label style="float:left; width: 150px;height: 35px;">Start Date</label>
		<input type="text" name="startdate" id="startdate" style="width: 200px;height: 35px;" value="<?php echo $_POST['startdate']; ?>"/>
		
		</br>
		
		<label style="float:left; width: 150px;">End Date</label>
		<input type="text" name="enddate" id="enddate" style="width: 200px;height: 35px;" value="<?php echo $_POST['enddate']; ?>"/>

		</br>
		
		<label style="float:left; width: 150px;">Amount ($)</label>
		<input type="text" name="amount" style="width: 200px;height: 35px;" value="<?php echo $_POST['amount']; ?>"/>
		
		</br>
		
		<label style="float:left; width: 150px;">Modifier (%)</label>
		<input type="text" name="modifier" style="width: 200px;height: 35px;" value="<?php echo $_POST['modifier']; ?>"/>
		
		</br>

		<label style="float:left; width: 150px;">Reference</label>
		<input type="text" name="reference" style="width: 200px;height: 35px;" value="<?php echo $_POST['reference']; ?>"/>
		
		</br>
		
		<input type="submit" value="Calculate" style="float: left;
    margin: 0 auto;
    position: relative;
    margin-top: 25px;
	margin-left: 150px;"/>
		
	  </form>
	  
	<?php
	if( $_POST['rulee'] && $_POST['startdate'] && $_POST['enddate'] && $_POST['amount']){
		?>
		</br>
		</br>
		<style>
		#result {
			margin-top: 50px;
		}
		#result td {
			text-align: center;
			font-size: 16px;
		}
		#result tr:first-child {
			background: #49494a;
			color: #fff;
		}
		#result tr:first-child td {
			border: 1px solid #fff;
		}
		</style>
		
		<table id="result">
			<tr>
				<td>
				Start Date
				</td>
				
				<td>
				End Date
				</td>
				
				<td>
				Days
				</td>
				
				<td>
				Rate
				</td>			
				
				<td style="width: 23%;">
				Amount Per Day
				</td>
				
				<td>
				Total
				</td>				
				
			</tr>

		<?php

		$startd = new DateTime($_POST['startdate']);
		$endd = new DateTime($_POST['enddate']);
		$fark = $endd->diff($startd)->format("%a");		
		
		if( $_POST['rulee']==1 ){
			$ara_rate = 10;
		}elseif($_POST['rulee']==2){
			$ara_rate = 1.5;
		}elseif($_POST['rulee']==3){
			$ara_rate = 5.5;
		}elseif($_POST['rulee']==4){
			$ara_rate = 7.5;
		}
		
		if ( $_POST['modifier'] ){
			$rate = $ara_rate + $_POST['modifier'];
		}else{
			$rate = $ara_rate;
		}
		$amount = $_POST['amount'];
		$formul = ( $amount * $rate ) / 36000;
	
		$export = '<tr>';
		
		$export .= '<td>';
		$export .= $_POST['startdate'];
		$export .= '</td>';
		
		$export .= '<td>';
		$export .= $_POST['enddate'];
		$export .= '</td>';
		
		$export .= '<td>';
		$export .= $fark;
		$export .= '</td>';

		$export .= '<td>';
		$export .= $rate.'%';
		$export .= '</td>';

		$export .= '<td>';
		$export .= '$'.round($formul,4);
		$export .= '</td>';

		$export .= '<td>';
		$export .= '$'.round(($formul * $fark),2);
		$export .= '</td>';
		
		$export .= '</tr>';
		
		echo $export;
		?>
		</table>
		<?php
	}
	?>
	</div><!-- .entry-content -->

	<?php edit_post_link( __( 'Edit', 'twentyfifteen' ), '<footer class="entry-footer"><span class="edit-link">', '</span></footer><!-- .entry-footer -->' ); ?>

</article><!-- #post-## -->
