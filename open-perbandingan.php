<?php include './includes/api.php';
include './includes/header.php';
akses_pengguna(array(2,3));
?>
<div class="container-fluid">

<?php

    echo '<h3 class="m-0 font-weight-bold text-primary"><span class="fas fa-table"></span> Data Kriteria</h3><hr>';
    ?>
    
   
    <form action="./perbandingan-kriteria" class="mx-auto" style="max-width:400px" autocomplete="off">
        <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="periode">Pilih Periode</label>
            <div class="col-sm-6">
               <!-- <select class="form-control" name="periode" id="periode" required>
                <option></option>
                <?php for ($i = 2020; $i <= 2023; $i++) : ?>
                    <option value="<?= $i ?>"><?= $i ?></option>
                <?php endfor; ?>
                </select> 
               <input type="date" name="periode" id="periode" class="form-control datepicker" required="on"> -->
			   
			   
			  <?php  
				  $currently_selected = date('Y'); 
				  $earliest_year = 2019; 
				  $latest_year = 2030; 

				  print '<select name="periode" >';
				  print '<option value="" disabled selected hidden>Pilih tahun ajaran</option>';
					foreach ( range( $latest_year, $earliest_year ) as $i ) {
						$x = $i-1;
					print '<option name = "periode" align = "center" id = "periode" value="'.$i.'"'.($i === $currently_selected ? ' selected="selected"' : '').'>'.$x.' / '.$i.'</option>';
				  }
				  print '</select>';
				  ?>
            </div>
           <button class="col-sm-2 btn btn-primary" type="submit" >Pilih</button>
		   <!--<button class="btn btn-primary" onclick="buka_perbandingan('<?= $periode?>')"><span class="fas fa-plus-circle"></span> Pilih</button> -->
        </div>
    </form>

</div>



<?php include './includes/footer.php';?>