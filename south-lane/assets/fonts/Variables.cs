using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.SessionState;
using System.Web.UI.WebControls;
/// <summary>
/// Class to save session, temporary variables.
/// </summary>
public class Variables
{
    static public DVEDataContext db = new DVEDataContext();
    static public String loginname;
    static public String typeret;
    String Email1;
    String Password1;
    String Type1;

    public Variables()
    {
        
    }
    public Variables(String name,String type)
    {
        loginname = name;
        typeret = type;
    }
     public  String give ()
    {
        return loginname;
    }

    public String give2()
    {
        return typeret;
    }
    public String give3()
    {
        return Email1;
    }
    public void session(String email, String Pw, String type)
    {
        Email1 = email;
        Password1 = Pw;
        Type1 = type;
        String time = DateTime.Now.ToString("HH:mm:ss tt");
        

        LoginRecord s = new LoginRecord()
        {
            Name = loginname,
            Email = Email1,
            Password = Password1,
            Type = Type1,
            SigningTime = time
                        
                    };
        try
        {
            db.LoginRecords.InsertOnSubmit(s);
            db.SubmitChanges();

        }
        catch (Exception)
        {
            
        }


    }
 
}