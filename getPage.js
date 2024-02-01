const { chromium } = require('playwright');

const myArgs = process.argv.slice(2);
const url = myArgs[0];
const server = myArgs[1];
const user = myArgs[2];
const password = myArgs[3];

(async ()=> {
    let param = {};
    let browser;
    let page;
    let context;
    if (server && user && password) {
        param = {
            proxy: {
                server: server,
                username: user,
                password: password
            }
        }
    }
    try {
        browser = await chromium.launch(param);
        context = await browser.newContext({
            userAgent: 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36',
            viewport: {
                width: 1920,
                height: 1080,
            }
        });
        page = await context.newPage();
        await page.goto(url, {waitUntil: "networkidle", timeout: 60000});
        console.log(JSON.stringify({content: await page.content(), cookie: await context.cookies()}))
    } catch (e) {
        console.log(JSON.stringify({status: 'error', error: e.message}));
    } finally {
        await browser.close();
        process.exit();
    }
})();

(async () => {
    setTimeout(() => {
        console.log(JSON.stringify({status: 'error', error: 'timeout'}));
        process.exit(1)
    }, 120000)
})()