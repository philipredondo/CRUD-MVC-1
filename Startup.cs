using Microsoft.Owin;
using Owin;

[assembly: OwinStartupAttribute(typeof(firstMVC.Startup))]
namespace firstMVC
{
    public partial class Startup
    {
        public void Configuration(IAppBuilder app)
        {
            ConfigureAuth(app);
        }
    }
}
