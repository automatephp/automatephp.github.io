<template>
  <div class="container_advantages section section3">
    <div class="advantages">
      <div class="item">
        <h2>Consistency</h2>
        <p>This is the end of much inconsistency between your platforms, everything is deploying in parallel. If one failed, all others are stopped immediately.</p>
      </div>
      <div class="item">
        <h2>Atomic deploys</h2>
        <p>Your application is integrally built, then deployed instantly with symlinks.</p>
      </div>
      <div class="item">
        <h2>Zero downtime</h2>
        <p>As long as the new deployment is not succesful, the last one stays online until the last moment.</p>
      </div>
      <div class="item">
        <h2>Deploy to multiples servers</h2>
        <p>Configure all your remotes servers: development, pre-production and production one in the same place. Automate take care of the rest!</p>
      </div>
      <div class="item">
        <h2>Deploy any project</h2>
        <p>Automate can work with any type of project! PHP, JS, Ruby,.. It’s a polyvalent Automate ! ;) </p>
      </div>
      <div class="item">
        <h2>Travis / Gitlab-ci</h2>
        <p>You can use Automate from your workstation or through an integration server like Travis or Gitlab-ci.</p>
      </div>
      <div class="item">
        <h2>Best practice</h2>
        <p>Automate has very clean and well tested code. <br> The repository is watched by many code quality tools, and every pull request is also checked by QA tools.</p>
        <div class="line">
          <a href="https://travis-ci.org/automatephp/automate">
            <img
              src="https://travis-ci.org/automatephp/automate.svg?branch=master"
              alt="build"
            >
          </a>
          <a href="https://insight.sensiolabs.com/projects/d8cbccde-24d4-4909-910f-b7baaaf26f30">
            <img
              src="//insight.sensiolabs.com/projects/d8cbccde-24d4-4909-910f-b7baaaf26f30/mini.png"
              alt="insight"
            >
          </a>
          <a href="https://scrutinizer-ci.com/g/automatephp/automate/?branch=master">
            <img
              src="https://scrutinizer-ci.com/g/automatephp/automate/badges/quality-score.png?b=master"
              alt="quality score"
            >
          </a>
          <a href="https://scrutinizer-ci.com/g/automatephp/automate/?branch=master">
            <img
              src="https://scrutinizer-ci.com/g/automatephp/automate/badges/coverage.png?b=master"
              alt="coverage"
            >
          </a>
        </div>
      </div>
    </div>
    <a href="https://github.com/automatephp/automate" class="btn_orange btn_git"><i class="fa fa-github "></i>Github</a>
  </div>
</template>

<script>
  export default {
    name: "advantages",
  }
</script>
