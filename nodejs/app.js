const http = require('http');
const fetch = require('node-fetch');

const hostname = '0.0.0.0';
const port = 3000;

const fibo1 = (number) => {
    if(number <= 0) return 0;
    if(number < 2) return 1;

    return fibo1(number - 1) + fibo1(number - 2);
};

const server = http.createServer((req, res) => {
    res.statusCode = 200;
    res.setHeader('Content-Type', 'text/plain');

    const url = new URL(req.url, `http://${req.headers.host}`);

    switch(url.pathname){
        case '/hello':
            res.end('Hello World!');
            return;
        case '/fibo1':
            res.end('' + fibo1(url.searchParams.number || 0));
            return;
        case '/fibo2':
            let result = 0;

            if(url.searchParams.number <= 0) {
                result = 0;
            }else if(url.searchParams.number < 2) {
                result = 1;
            }else{
                let count = url.searchParams.number || 0;
                let i, num1 = 0, num2 = 1;
                for (i = 2; i <= count; i++) {
                    result = num1 + num2;
                    num1 = num2;
                    num2 = result;
                }
        
            }
        
            res.end('' + result)
            return;
        case '/io':
            (async _ => {
                const apiRequest = await fetch("http://nginx/index.html");
                const text = await apiRequest.text();
            
                res.end('' + text.length)
            })();
            return;
        default:
            res.end('');
            return;
    }
});

server.listen(port, hostname, () => {
    console.log(`Server running at http://${hostname}:${port}/`);
});