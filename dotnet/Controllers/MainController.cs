using System;
using System.Collections.Generic;
using System.Net.Http;
using System.Threading.Tasks;
using Microsoft.AspNetCore.Mvc;
using Microsoft.Extensions.Logging;

namespace dotnet.Controllers
{
    [ApiController]
    public class MainController : ControllerBase
    {
        static readonly HttpClient client = new HttpClient();

        public MainController()
        {
        }

        [HttpGet("/hello")]
        public string Hello()
        {
            return "Hello World!";
        }

        [HttpGet("/fibo1")]
        public string Fibo1(string number)
        {
            return CalFibo1(int.Parse(number)).ToString();
        }

        [HttpGet("/fibo2")]
        public string Fibo2(string number)
        {
            int result = 0;
            int intNumber = int.Parse(number);

            if(intNumber <= 0) {
                result = 0;
            }else if(intNumber < 2) {
                result = 1;
            }else{
                int count = intNumber;
                int i, num1 = 0, num2 = 1;
                for (i = 2; i <= count; i++) {
                    result = num1 + num2;
                    num1 = num2;
                    num2 = result;
                }
            }

            return result.ToString();
        }

        [HttpGet("/io")]
        public async Task<string> IO()
        {
            HttpResponseMessage response = await client.GetAsync("http://nginx/index.html");
            string responseBody = await response.Content.ReadAsStringAsync();

            return responseBody.Length.ToString();
        }


        private int CalFibo1(int number){
            if(number <= 0) return 0;
            if(number < 2) return 1;

            return CalFibo1(number - 1) + CalFibo1(number - 2);
        }
    }
}
