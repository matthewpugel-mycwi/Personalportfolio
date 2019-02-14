using System;
using System.Collections;
using System.Collections.Generic;
using System.Text;
namespace Mpworks
{
    #region Visitor
    public class Visitor
    {
        #region Member Variables
        protected int _visitor_id;
        protected string _visitor_name;
        protected string _visitor_email;
        protected string _visitor_msg;
        #endregion
        #region Constructors
        public Visitor() { }
        public Visitor(string visitor_name, string visitor_email, string visitor_msg)
        {
            this._visitor_name=visitor_name;
            this._visitor_email=visitor_email;
            this._visitor_msg=visitor_msg;
        }
        #endregion
        #region Public Properties
        public virtual int Visitor_id
        {
            get {return _visitor_id;}
            set {_visitor_id=value;}
        }
        public virtual string Visitor_name
        {
            get {return _visitor_name;}
            set {_visitor_name=value;}
        }
        public virtual string Visitor_email
        {
            get {return _visitor_email;}
            set {_visitor_email=value;}
        }
        public virtual string Visitor_msg
        {
            get {return _visitor_msg;}
            set {_visitor_msg=value;}
        }
        #endregion
    }
    #endregion
}