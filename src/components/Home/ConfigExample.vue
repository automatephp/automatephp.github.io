<template>
  <div style="position: relative;">
    <div class="line_ellipse">
      <span/>
      <span/>
      <span/>
    </div>
    <pre class="code-config-example language-yaml"><code v-html="codeConfig()"></code></pre>
  </div>
</template>

<script>
  import codeConfigExample from '../../../static/config-example.yaml';

  export default {
    name: "config-example",
    data() {
      return {
        codeConfigExample,
      }
    },
    methods: {
      codeConfig() {
        let lineNb=1;
        return codeConfigExample.split('\n').map((line) => {
          return '<span class="line-number-position">&#x200b;<span class="line-number">' + lineNb++ + '</span></span>'+line;
        }).join('\n');
      },
    },
  }
</script>
