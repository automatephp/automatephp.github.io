
# Plugins

## Notification

### Slack

```YAML
plugins:
    ...
    slack:
        hook_uri: "https://hooks.slack.com/services/xxxxx/yyyyy/zzzzz"
        messages:                            # Optional
            success: "Success great !"
            failed: "Failed deployment"
```

### Gitter

```YAML
plugins:
    ...
    gitter:
        token: 132456
        room: 654321
        messages:                            # Optional
            success: "Success great !"
            failed: "Failed deployment"
```

## Clear cache system

With Automate you have the possibility to clear automatically the `opcache` or `apcu` or `apc` cache system, you should specify each technology available like this:

```YAML
plugins:
    cache_tool:
        version: 3.2.1 #Optional: Check the right version you need here : https://github.com/gordalina/cachetool/releases 
        opcache: true
        apcu: false
        apc: false
```
