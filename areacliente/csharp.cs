using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace FormParImpar
{
    public partial class FormFarmacia : Form
    {
        decimal valoruni,subtotal, total, quant;
        

        public void add_marcas()
        {
            cb_Marca.Items.Add("Selecione a marca");
            cb_Marca.Items.Add("1");
            cb_Marca.Items.Add("2");
            cb_Marca.Items.Add("3");
            txtbmask_ValorUni.Enabled= false;
            txtbmask_SubTotal.Enabled= false;
            txtbmask_Total.Enabled= false;
        }
        public FormFarmacia()
        {
            InitializeComponent();
            add_marcas();
            cb_Marca.SelectedItem = "Selecione a marca";
        }

        private void btn_Limpar_Click(object sender, EventArgs e)
        {
            txtbmask_SubTotal.Clear();
            txtbmask_Total.Clear();
            txtbmask_ValorUni.Clear();


            cb_Medicamento.Text = "MEDICAMENTO";
            cb_Marca.Text = "MARCA";
            cb_Medicamento.Enabled= false;
            

            txtb_Cred1x.Clear();
            txtb_Cred2x.Clear();
            txtb_Cred3x.Clear();
            txtb_Cred4x.Clear();
            txtb_Qtd.Clear();
            txtb_Vista.Clear();

            groupBox1.Enabled= false;
            groupBox2.Enabled= false;


        }

        private void txtb_Qtd_TextChanged(object sender, EventArgs e)
        {
            /*decimal valor;
            bool numero = decimal.TryParse(txtValor.Text, out valor);
            if (numero == false) { lblWarn.Text = "!"; txtValor.Clear(); }
            else { lblWarn.Text = ""; }*/
            try
            {
                rb_Vista.Enabled = false;
                rb_Cred1.Enabled = false;
                rb_Cred2.Enabled = false;
                rb_Cred3.Enabled = false;
                rb_Cred4.Enabled = false;



                quant = Convert.ToDecimal(txtb_Qtd.Text);
                valoruni = Convert.ToDecimal(txtbmask_ValorUni.Text);
                subtotal = quant * valoruni;
                txtbmask_SubTotal.Text = subtotal.ToString();
                groupBox1.Enabled = true;
                groupBox2.Enabled = true;

            }
            catch (Exception)
            {

            }
        }

        private void cb_Marca_SelectedIndexChanged(object sender, EventArgs e)
        {
            

            if (cb_Marca.Text == "1")
            {
                
                cb_Medicamento.Items.Clear();
                cb_Medicamento.Items.Add("Bayer");
                cb_Medicamento.Enabled = true;
            }
            if (cb_Marca.Text == "2")
            {
                cb_Medicamento.Items.Clear();
                cb_Medicamento.Items.Add("Corp");
                

                cb_Medicamento.Enabled = true;

            }
            if (cb_Marca.Text == "3")
            {
                cb_Medicamento.Items.Clear();
                cb_Medicamento.Items.Add("Es");

                cb_Medicamento.Enabled = true;

            }
        }

        private void cb_Medicamento_SelectedIndexChanged(object sender, EventArgs e)
        {
            //decimal valoruni = Convert.ToDecimal(txtbmask_ValorUni.Text);
            switch (cb_Medicamento.Text)
            {
                case "Corp":
                    valoruni = 10;
                    
                    break;
                case "Bayer":
                    valoruni = 50;
                    
                    break;
                case "Es":
                    valoruni = 100;
                    
                    break;
                default:
                    txtbmask_ValorUni.Text = "";
                    break;
            }
            txtbmask_ValorUni.Text = valoruni.ToString();
        }

        private void rb_Vista_CheckedChanged(object sender, EventArgs e)
        {
            
            total = subtotal;
            txtbmask_Total.Text = total.ToString();
            btn_Comprar.Enabled = true;
        }

        private void rb_Dinheiro_CheckedChanged(object sender, EventArgs e)
        {
            //FORMA DE PAGAMENTO

            decimal total;
            try
            {

                rb_Vista.Enabled = true;
                rb_Cred1.Enabled = false;
                rb_Cred2.Enabled = false;
                rb_Cred3.Enabled = false;
                rb_Cred4.Enabled = false;

                txtb_Cred1x.Enabled = false;
                txtb_Cred2x.Enabled = false;
                txtb_Cred3x.Enabled = false;
                txtb_Cred4x.Enabled = false;


                btn_Comprar.Enabled = true;

                total = subtotal - (subtotal * 15) / 100;
                txtbmask_Total.Text = total.ToString();
                
            }
            catch (Exception)
            {

                throw;
            }
        }

        private void rb_Credito_CheckedChanged(object sender, EventArgs e)
        {
            //FORMA DE PAGAMENTO

            //decimal total, subtotal = Convert.ToDecimal(txtbmask_SubTotal.Text);
            if (decimal.TryParse(txtbmask_Total.Text, out total))
            {
                

                if (total <= 50)
                {
                    rb_Vista.Enabled = true;

                    rb_Cred1.Enabled = false;
                    txtb_Cred1x.Enabled = false;
                    rb_Cred2.Enabled = false;
                    txtb_Cred2x.Enabled = false;
                    rb_Cred3.Enabled = false;
                    txtb_Cred3x.Enabled = false;
                    rb_Cred4.Enabled = false;
                    txtb_Cred4x.Enabled = false;

                }
                else if (total > 100 && total <= 110)
                {
                    rb_Vista.Enabled = true;

                    rb_Cred1.Enabled = true;
                    txtb_Cred1x.Enabled = true;
                    rb_Cred2.Enabled = false;
                    txtb_Cred2x.Enabled = false;
                    rb_Cred3.Enabled = false;
                    txtb_Cred3x.Enabled = false;
                    rb_Cred4.Enabled = false;
                    txtb_Cred4x.Enabled = false;

                }
                else if (total > 200 && total <= 220)
                {
                    rb_Vista.Enabled = true;

                    rb_Cred1.Enabled = true;
                    txtb_Cred1x.Enabled = true;
                    rb_Cred2.Enabled = true;
                    txtb_Cred2x.Enabled = true;
                    rb_Cred3.Enabled = false;
                    txtb_Cred3x.Enabled = false;
                    rb_Cred4.Enabled = false;
                    txtb_Cred4x.Enabled = false;

                }
                else if (total > 400)
                {
                    rb_Vista.Enabled = true;

                    rb_Cred1.Enabled = true;
                    txtb_Cred1x.Enabled = true;
                    rb_Cred2.Enabled = true;
                    txtb_Cred2x.Enabled = true;
                    rb_Cred3.Enabled = true;
                    txtb_Cred3x.Enabled = true;
                    rb_Cred4.Enabled = false;
                    txtb_Cred4x.Enabled = false;

                }
                else if (total > 500)
                {
                    rb_Vista.Enabled = true;

                    rb_Cred1.Enabled = true;
                    txtb_Cred1x.Enabled = true;
                    rb_Cred2.Enabled = true;
                    txtb_Cred2x.Enabled = true;
                    rb_Cred3.Enabled = true;
                    txtb_Cred3x.Enabled = true;
                    rb_Cred4.Enabled = true;
                    txtb_Cred4x.Enabled = true;

                }
            }
            else
            {
                // The value in msktxtb_Total is not a valid decimal number
                try
                {

                    rb_Vista.Enabled = true;
                    rb_Cred1.Enabled = true;
                    rb_Cred2.Enabled = true;
                    rb_Cred3.Enabled = true;
                    rb_Cred4.Enabled = true;


                    txtbmask_Total.Clear();

                    txtb_Vista.Text = subtotal.ToString();

                    txtb_Cred1x.Text = subtotal.ToString();
                    txtb_Cred2x.Text = (subtotal / 2).ToString();
                    txtb_Cred3x.Text = (subtotal / 3).ToString();
                    txtb_Cred4x.Text = (subtotal / 4).ToString();
                    
                }
                catch (Exception)
                {

                    throw;
                }
            }
        }

        private void rb_Cred1_CheckedChanged(object sender, EventArgs e)
        {
            //FORMA DE PAGAMENTO
            total = subtotal;
            txtbmask_Total.Text = total.ToString();
            btn_Comprar.Enabled = true;
        }

        private void txtbmask_SubTotal_MaskInputRejected(object sender, MaskInputRejectedEventArgs e)
        {
            //FORMA DE PAGAMENTO

            subtotal = valoruni * quant;
            txtbmask_SubTotal.Text = subtotal.ToString(); 
        }

        private void rb_Cred2_CheckedChanged(object sender, EventArgs e)
        {
            //FORMA DE PAGAMENTO

            total = subtotal / 2;
            txtbmask_Total.Text = total.ToString();
            btn_Comprar.Enabled = true;
        }

        private void rb_Cred3_CheckedChanged(object sender, EventArgs e)
        {
            //FORMA DE PAGAMENTO

            total = subtotal / 3;
            txtbmask_Total.Text = total.ToString();
            btn_Comprar.Enabled = true;
        }

        private void rb_Cred4_CheckedChanged(object sender, EventArgs e)
        {
            //FORMA DE PAGAMENTO

            total = subtotal / 4;
            txtbmask_Total.Text = total.ToString();
            btn_Comprar.Enabled = true;
        }
    }
}
