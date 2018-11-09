<template>
  <div>
    <div class="line_ellipse">
      <span></span>
      <span></span>
      <span></span>
    </div>
    <div id="player-container"></div>
  </div>
</template>

<script>

  import '../../asciinema/asciinema-player.js';

  export default {
    name: "demo",
    mounted: () => {
      asciinema.player.js.CreatePlayer('player-container', '/demo.cast', {
        'autoPlay': true,
        'loop': true,
        'speed': 1,
        'cols': 120,
        'rows': 47,
        'fontSize': "small",
        'theme': "tango"
      });
    },
  }
</script>
