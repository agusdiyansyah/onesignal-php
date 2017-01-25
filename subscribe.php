<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title></title>
        <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async='async'></script>
		<script>
			var OneSignal = window.OneSignal || [];
			OneSignal.push(["init", {
				appId: "3c43fcf7-e1a9-4540-a9b4-0f717a39d71a",
				autoRegister: false, /* Set to true to automatically prompt visitors */
				subdomainName: 'foundation',
				/*
				subdomainName: Use the value you entered in step 1.4: http://imgur.com/a/f6hqN
				*/
				httpPermissionRequest: {
					enable: true
				},
				notifyButton: {
				  enable: true /* Set to false to hide */
				}
			}]);
		</script>
    </head>
    <body id="body">
        
    </body>
    <script type="text/javascript">
        OneSignal.push(function() {
            OneSignal.getUserId(function(userId) {
                document.getElementById("body").innerHTML = "<h1>"+userId+"</h1>";
            });
        });
    </script>
</html>