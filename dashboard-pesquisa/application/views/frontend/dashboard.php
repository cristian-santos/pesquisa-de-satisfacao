<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-AU-compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $subtitulo ?></title>
        <link href="<?php echo base_url('assets/css/style.css') ?>" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/pikaday/css/pikaday.css">
      </head>
    <body>
    <div class="title">
        <div class="logo">
          <img src="assets/img/stark.png">
        </div>
          <h1></h1>
      </div>

  <h3 class="filtro">Filtrar por data:</h3>
    <div class="row">
      <div class="col-sm-2 dtinicio">
        <form action="<?php base_url('dashboard') ?>" method="POST">
            <label class="control-label">Data inicial</label>
            <input class="form-control" type="text" id="dtinicio" name="dtinicio" value="<?php echo !empty($dtinicio) ? $dtinicio : '' ?>">
      </div>

    <div class="col-sm-2 dtfim">
          <label class="control-label">Data final</label>
          <input class="form-control" type="text" id="dtfim" name="dtfim" value="<?php echo !empty($dtfim) ? $dtfim : '' ?>">  
    </div>

    <div class="col-sm-2 botao">
        <button type="submit" class="btn btn-success" value="ENVIAR">Buscar</i></button>
    </div>
  </div>
</form>
<h1 class="title">Total das estrelas por avaliação</h1>
      <table class="table table-striped table-hover tabela">
          <tr>
            <th>Nível de gentileza</th>
            <th>Nível de Satisfação</th>
            <th>Chance de Indicação</th>
            <th>Total de Avaliações</th>
          </tr>
        <?php foreach ($pesquisa as $indice) : ?>
          <tr>
            <td><?= $indice->nivel_gentileza ?>&#9733;</td>
            <td><?= $indice->nivel_satisfacao ?>&#9733;</td>
            <td><?= $indice->chance_indicacao ?>&#9733;</td>
            <td><?= $indice->nivel_gentileza + $indice->nivel_satisfacao + $indice->chance_indicacao ?>&#9733;</td>
          </tr>
        <?php endforeach ?>
      </table>

      <h1 class="title">Representação Gráfica</h1>
<div class="bd">
<div class="container">
  <?php if (empty($pesquisa[0]->nivel_gentileza) && empty($pesquisa[0]->nivel_satisfacao) && empty($pesquisa[0]->chance_indicacao)) {?>
    <h1 align="center">Não existem avaliações no período solicitado</h1>
    <?php } else { ?>
  <div class="inner">
    <div class="rating">
      <span class="rating-num"><?php echo number_format(($total_rating), 1, '.','') ?></span>
      <div class="rating-stars">
        <span><i class="<?php echo number_format(($total_rating), 1, '.','') >= 1 ? 'active icon-star ' : 'icon-star';?>"></i></span>
        <span><i class="<?php echo number_format(($total_rating), 1, '.','') >= 2 ? 'active icon-star ' : 'icon-star';?>"></i></span>
        <span><i class="<?php echo number_format(($total_rating), 1, '.','') >= 3 ? 'active icon-star ' : 'icon-star';?>"></i></span>
        <span><i class="<?php echo number_format(($total_rating), 1, '.','') >= 4 ? 'active icon-star ' : 'icon-star';?>"></i></span>
        <span><i class="<?php echo number_format(($total_rating), 1, '.','') >= 5 ? 'active icon-star ' : 'icon-star';?>"></i></span>
      </div>
      <div class="rating-users">
        <i class="icon-user"> Total de votantes: </i> <?php echo $total_votantes->count; ?>
      </div>
    </div>
    
    <div class="histo">
      <div class="five histo-rate">
        <span class="histo-star">
          <i class="active icon-star"></i> 5           </span>
        <span class="bar-block">
          <span id="bar-five" class="bar">
            <span><?= number_format(($total_five_star), 2, '.','') ?>%</span style="border:1px solid black">&nbsp;</span> 
          </span>
      </div>
      
      <div class="four histo-rate">
        <span class="histo-star">
          <i class="active icon-star"></i> 4           </span>
        <span class="bar-block">
          <span id="bar-four" class="bar">
            <span><?= number_format(($total_four_star), 2, '.','')?>%</span>&nbsp;
          </span> 
        </span>
      </div> 
      
      <div class="three histo-rate">
        <span class="histo-star">
          <i class="active icon-star"></i> 3           </span>
        <span class="bar-block">
          <span id="bar-three" class="bar">
            <span><?= number_format(($total_three_star), 2, '.','') ?>%</span>&nbsp;
          </span> 
        </span>
      </div>
      
      <div class="two histo-rate">
        <span class="histo-star">
          <i class="active icon-star"></i> 2           </span>
        <span class="bar-block">
          <span id="bar-two" class="bar">
            <span><?= number_format(($total_two_star), 2, '.','') ?>%</span>&nbsp;
          </span> 
        </span>
      </div>
      
      <div class="one histo-rate">
        <span class="histo-star">
          <i class="active icon-star"></i> 1           </span>
        <span class="bar-block">
          <span id="bar-one" class="bar">
            <span><?= number_format(($total_one_star), 2, '.','') ?>%</span>&nbsp;
          </span> 
        </span>
      </div>
    </div>
  </div>
  <?php } ?>
</div>
</div>
		
<script>
    var grafico_five = <?php echo json_encode($total_five_star); ?>
</script>

<script>
     var grafico_four = <?php echo json_encode($total_four_star); ?>
</script>

<script>
     var grafico_three = <?php echo json_encode($total_three_star); ?>
</script>

<script>
     var grafico_two = <?php echo json_encode($total_two_star); ?>
</script>

<script>
     var grafico_one = <?php echo json_encode($total_one_star); ?>
</script>

<script type="text/javascript" src="<?php echo base_url('assets/js/script.js')?>"></script>

<!-- Inicio do Script de data -->
<script>
    var picker = new Pikaday({
        field: document.getElementById('dtinicio'),
        format: 'D/M/YYYY',
        toString(date, format) {
            const day = date.getDate();
            const month = date.getMonth() + 1;
            const year = date.getFullYear();
            return `${day}/${month}/${year}`;
            
        },
        parse(dateString, format) {
            const parts = dateString.split('/');
            const day = parseInt(parts[0], 10);
            const month = parseInt(parts[1], 10) - 1;
            const year = parseInt(parts[2], 10);
            return new Date(year, month, day);
            
        },
        i18n: {
        previousMonth : 'Previous Month',
        nextMonth     : 'Next Month',
        months        : ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
        weekdays      : ['Domingo','Segunda-feira','terça-feira','Quarta','Quinta','Sexta','Sábado'],
        weekdaysShort : [ 'Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb' ]
}     
    });
</script>

<script>
    var picker = new Pikaday({
        field: document.getElementById('dtfim'),
        format: 'D/M/YYYY',
        toString(date, format) {
            const day = date.getDate();
            const month = date.getMonth() + 1;
            const year = date.getFullYear();
            return `${day}/${month}/${year}`;
        },
        parse(dateString, format) {
            const parts = dateString.split('/');
            const day = parseInt(parts[0], 10);
            const month = parseInt(parts[1], 10) - 1;
            const year = parseInt(parts[2], 10);
            return new Date(year, month, day);  
        },
        i18n: {
        previousMonth : 'Previous Month',
        nextMonth     : 'Next Month',
        months        : ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
        weekdays      : ['Domingo','Segunda-feira','terça-feira','Quarta','Quinta','Sexta','Sábado'],
        weekdaysShort : [ 'Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb' ]
      }     
    });
</script>
<!-- Fim do Script de data -->
  </body>
</html>