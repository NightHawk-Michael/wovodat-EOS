import java.io.BufferedOutputStream;
import java.io.BufferedReader;
import java.io.BufferedWriter;
import java.io.File;
import java.io.FileNotFoundException;
import java.io.FileOutputStream;
import java.io.FileReader;
import java.io.FileWriter;
import java.io.IOException;
import java.util.ArrayList;
import java.util.List;
import java.util.Scanner;
import java.util.logging.Level;
import java.util.logging.Logger;
import java.util.Random;
import Jama.*;

class upd {

	public static  void Writer(String File,String BB){
		try{
			FileWriter fstream = new FileWriter(File,true);
			BufferedWriter fbw = new BufferedWriter(fstream);
			fbw.write(BB);
			fbw.newLine();
			fbw.close();
		}catch (Exception e) {
			System.out.println("Error: " + e.getMessage());
		}
	}

	public static void Rewrite(String Files, String str) {
		try{
			FileOutputStream fos = new FileOutputStream(Files);
			BufferedOutputStream bos = new BufferedOutputStream(fos);
			bos.write(str.getBytes());
			bos.flush();
		}catch (IOException e){
			System.err.println("Error writing to a file: " + e);
		}
	}

	public static  ArrayList Read(String AnyFile){   
	  ArrayList textdata = new ArrayList();                
		 try {
				File file = new File(AnyFile);
				FileReader fr = new FileReader(file);
				BufferedReader textReader =new BufferedReader(fr);
				String line="";
				while ((line=textReader.readLine()) != null) {
				   textdata.add(line);
				}  
			  } catch (FileNotFoundException ex) {} catch (IOException ex) {}
	  return textdata;
	}

	public static double get_double(String Variable){
		String [] Var = Variable.split("=");
		double parameter=Double.parseDouble(Var[1]);
		return parameter;
	}

}
 
class MYNNBP {
	
	String Training_set = "";
	String Weights_Factors_and_Bias = "";
	String Prediction_set = "";
	ArrayList row= new ArrayList();
	String[] col = {};
	int In = 0;
	int Kn = 0;
	double[][] Input = new double[Kn][In];
	double[] Output = new double[Kn];
	String[] dataholder=new String[In+1];

	public MYNNBP Prepare_Training_Data_Set(){
		Kn--;
		for (int k=0;k<Kn;k++){
			dataholder = row.get(k+1).toString().split("\t");
			for (int i=0;i<In;i++){
				Input[k][i] = Double.parseDouble(dataholder[i]);
			}
			Output[k]=Double.parseDouble(dataholder[In]);
		}
		return this;
	}

	double[] GBmax = new double[In+1];
	double[] GBmin = new double[In+1];
	double[] GBave = new double[In+1];

	public MYNNBP Normalize_Data(){
		
		for (int i=0;i<In;i++){
			GBmax[i] = Input[0][i];
			GBmin[i] = Input[0][i];
			GBave[i] = 0;
		}

		GBmax[In] = Output[0];
		GBmin[In] = Output[0];
		GBave[In] = 0;
			
		for (int k=0;k<Kn;k++){
			for (int i=0;i<In;i++){
				GBmax[i] = Math.max(GBmax[i],Input[k][i]);
				GBmin[i] = Math.min(GBmin[i],Input[k][i]);
				GBave[i] = GBave[i] + Input[k][i];
			}
			GBmax[In]=Math.max(GBmax[In],Output[k]);
			GBmin[In]=Math.min(GBmin[In],Output[k]);
			GBave[In] = GBave[In] + Output[k];
		}

		for(int i=0;i<In+1;i++){
			GBave[i] = GBave[i]/Kn;
		}

		for (int k=0;k<Kn;k++){
			for (int i=0;i<In;i++){
				Input[k][i]=2*(Input[k][i]-GBmin[i])/(GBmax[i]-GBmin[i])-1;
			}
			Output[k]=(Output[k]-GBmin[In])/(GBmax[In]-GBmin[In]);
		}
		return this;
	}

	int Hn = 0;        
	double Alp = 0;
	double[] Bet = new double[Hn];
	double b = 0;
	double[][] Vij = new double[In][Hn];
	double[] Wj = new double[Hn];
	double[] Cj = new double[Hn];
	
	double oAlp = 0;
	double[] oBet = new double[Hn];
	double ob = 0;
	double[][] oVij = new double[In][Hn];
	double[] oWj = new double[Hn];
	double[] oCj = new double[Hn];

	public MYNNBP Randomized_Weights_Factors_Bias(){
		Random r = new Random();		
		Alp = r.nextGaussian();//Math.random();
		b = r.nextGaussian();//Math.random();
		for (int j=0;j<Hn;j++){
			Wj[j]=r.nextGaussian();//Math.random();
			Cj[j]=r.nextGaussian();
			Bet[j] = r.nextGaussian();//Math.random();
			for (int i=0;i<In;i++){
				Vij[i][j]=r.nextGaussian();//Math.random();   
			}
		}
		return this;
	} 

	double[] Hj=new double[Hn];

	public double Estimate_Out(double[] Ii){
		this.Ii = Ii;
		for (int j=0;j<Hn;j++){
			Hj[j]=0;
			for (int i=0;i<In;i++){
				Hj[j]=Hj[j]+Ii[i]*Vij[i][j];   
			}
			EIiVij[j] = Hj[j];
			Hj[j]= Math.tanh(Bet[j]*Hj[j]+Cj[j]);
		}
		double out=0;
		for (int j=0;j<Hn;j++){
			out=out+Hj[j]*Wj[j];
		}
		EHjWj = out;
		out= Math.tanh(Alp*out+b);
		return out;
	}

	double dE_dB = 0;
	double[] dE_dWj = new double[Hn];
	double dE_dAlp = 0;
	double[] dE_dCj = new double[Hn];
	double[][] dE_dVij = new double[In][Hn];
	double[] dE_dBj = new double[Hn];
	double EHjWj =0;
	double[] EIiVij = new double[Hn];
	double[] Ii = new double[In];
	double SSE = 1000;
	double nu = 0.0001;

	public MYNNBP Calculate_Output_and_Derivatives(){
		for (int k=0;k<Kn;k++){
			dE_dB = 0;
			dE_dAlp = 0;
			for (int j=0;j<Hn;j++){
				dE_dWj[j] = 0;
				dE_dCj[j] = 0;
				dE_dBj[j] = 0;
				for (int i=0;i<In;i++){
					dE_dVij[i][j] = 0;
				}
			}
		}
			
		SSE = 0; 
		int dim = 2+3*Hn+In*Hn;
		double[][] Jacobi = new double[Kn][dim];	
		double[] Eacobi = new double[dim];		
		for (int k=0;k<Kn;k++){			
			double O = Estimate_Out(Input[k]);
			double T = Output[k];
			//Eacobi[k] = T - O;
			SSE = SSE + 0.5*Math.pow((T-O),2);
			double del = (T-O)*(1.0-Math.pow(O,2));
			int jindex = 0;
			Jacobi[k][jindex] = del;
			dE_dB = dE_dB + Jacobi[k][jindex];			
			jindex++;
			Jacobi[k][jindex] = del * EHjWj;
			dE_dAlp = dE_dAlp + Jacobi[k][jindex];			
			jindex++;
			for (int j=0;j<Hn;j++){
				Jacobi[k][jindex] = del * Alp * Hj[j] + 2;
				dE_dWj[j] = dE_dWj[j] + Jacobi[k][jindex];
				jindex++;
				Jacobi[k][jindex] = del * Alp * Wj[j] * (1.0-Math.pow(Hj[j],2));
				dE_dCj[j] = dE_dCj[j] + Jacobi[k][jindex];				
				jindex++;
				Jacobi[k][jindex] = del * Alp * Wj[j] * (1.0-Math.pow(Hj[j],2)) * EIiVij[j];
				dE_dBj[j] = dE_dBj[j] + Jacobi[k][jindex];				
				jindex++;
				for (int i=0;i<In;i++){
					Jacobi[k][jindex] = del * Alp * Wj[j] * (1.0-Math.pow(Hj[j],2)) * Bet[j]*Ii[i];
					dE_dVij[i][j] = dE_dVij[i][j] + Jacobi[k][jindex];					
					jindex++;
				}
			}
		}
		
		int jindex = 0;
		Eacobi[jindex] = dE_dB;
		jindex++;
		Eacobi[jindex] = dE_dAlp;
		jindex++;
		for (int j=0;j<Hn;j++){
			Eacobi[jindex] = dE_dWj[j];
			jindex++;
			Eacobi[jindex] = dE_dCj[j];
			jindex++;
			Eacobi[jindex] = dE_dBj[j];
			jindex++;
			for (int i=0;i<In;i++){
				Eacobi[jindex] = dE_dVij[i][j];
				jindex++;
			}
		}
		
		Matrix Jack = new Matrix(Jacobi);
		Matrix Eack = new Matrix(Eacobi,dim);
		Matrix weights = ((Jack.transpose().times(Jack)).plus(Matrix.identity(dim,dim).times(nu))).inverse().times(Eack);
		
		//weights = weights.times(-1);
		jindex = 0;
		dE_dB = weights.get(jindex,0);
		jindex++;
		dE_dAlp = weights.get(jindex,0);
		jindex++;
		for (int j=0;j<Hn;j++){
			dE_dWj[j] = weights.get(jindex,0);
			jindex++;
			dE_dCj[j] = weights.get(jindex,0);
			jindex++;
			dE_dBj[j] = weights.get(jindex,0);
			jindex++;
			for (int i=0;i<In;i++){
				dE_dVij[i][j] = weights.get(jindex,0);
				jindex++;
			}
		}
		
		return this;
	}

	double del_Alp = 0;
	double[] del_Bj = new double[Hn];
	double del_b = 0;
	double[][] del_Vij = new double[In][Hn];
	double[] del_Wj = new double[Hn];
	double[] del_Cj = new double[Hn];

	public MYNNBP Initiate_Delta_Weights(){
		del_Alp = 0;
		del_b = 0;
		for (int j=0;j<Hn;j++){
			del_Wj[j] = 0;
			del_Cj[j] = 0;
			del_Bj[j] = 0;
			for (int i=0;i<In;i++){
				del_Vij[i][j] = 0;   
			}
		}
		return this;
	}

	double momentum = 1;
	double Learn_rate_Factor = 1;
	double Learn_rate_Bias = 1;
	double Learn_rate_Weight=1;
	public MYNNBP Calculate_Weights_Factors_and_Bias(){		
		del_Alp = momentum * del_Alp + Learn_rate_Factor * dE_dAlp;		
		Alp = Alp + del_Alp;
		del_b = momentum * del_b + Learn_rate_Bias * dE_dB;
		b = b + del_b;
		for (int j=0;j<Hn;j++){
			del_Wj[j] = momentum * del_Wj[j] + Learn_rate_Weight * dE_dWj[j];
			Wj[j] = Wj[j] + del_Wj[j];
			del_Cj[j] = momentum * del_Cj[j] + Learn_rate_Bias * dE_dCj[j];
			Cj[j] = Cj[j] + del_Cj[j];			
			del_Bj[j] = momentum * del_Bj[j] + Learn_rate_Factor * dE_dBj[j];
			Bet[j] = Bet[j] + del_Bj[j];
			for (int i=0;i<In;i++){
				del_Vij[i][j] = momentum * del_Vij[i][j] + Learn_rate_Weight * dE_dVij[i][j];  
				Vij[i][j] = Vij[i][j] + del_Vij[i][j];
			}
		}
		return this;
	}

	public MYNNBP Print_Architecture_Weights_Factors_and_Bias_to_text(String File_to_write){
		upd.Rewrite(File_to_write,"");
		upd.Writer(File_to_write,"In ="+In);
		upd.Writer(File_to_write,"Hn ="+Hn);
		upd.Writer(File_to_write,"Alp ="+Alp);
		upd.Writer(File_to_write,"b ="+b);
		for (int j=0;j<Hn;j++){
			upd.Writer(File_to_write,"Wj["+j+"] ="+Wj[j]);
			upd.Writer(File_to_write,"Cj["+j+"] ="+Cj[j]);
			upd.Writer(File_to_write,"Betj["+j+"] ="+Bet[j]);
			for (int i=0;i<In;i++){
				upd.Writer(File_to_write,"Vij["+i+"]["+j+"] ="+Vij[i][j]);
			}
		}
		for (int i=0;i<In+1;i++){
			upd.Writer(File_to_write,"GBmax["+i+"] ="+GBmax[i]);
			upd.Writer(File_to_write,"GBmin["+i+"] ="+GBmin[i]);
		}
		for (int i=0;i<In+1;i++){
			upd.Writer(File_to_write,col[i]);
		}
		return this;
	}

	public MYNNBP Initiate_Training_Variables(String DataFile,int Hidden_neurons){
		row= upd.Read(DataFile);
		col = row.get(0).toString().split("\t");
		In = col.length-1;
		Kn = row.size();
		Input = new double[Kn][In];
		Output = new double[Kn];
		dataholder=new String[In+1];
		GBmax = new double[In+1];
		GBmin = new double[In+1];
		GBave = new double[In+1];
		Hn = Hidden_neurons;        
		Alp = 0;
		Bet = new double[Hn];
		b = 0;
		Vij = new double[In][Hn];
		Wj = new double[Hn];
		Cj = new double[Hn];
		Hj=new double[Hn];
		dE_dB = 0;
		dE_dWj = new double[Hn];
		dE_dAlp = 0;
		dE_dCj = new double[Hn];
		dE_dVij = new double[In][Hn];
		dE_dBj = new double[Hn];
		EHjWj =0;
		EIiVij = new double[Hn];
		Ii = new double[In];
		SSE = 1.E+100;
		del_Alp = 0.0;
		del_Bj = new double[Hn];
		del_b = 0.0;
		del_Vij = new double[In][Hn];
		del_Wj = new double[Hn];
		del_Cj = new double[Hn];
		momentum = 0.7;
		Learn_rate_Factor = 0.1;
		Learn_rate_Bias = 0.1;
		Learn_rate_Weight = 0.2;
		return this;
	}

	public MYNNBP Initiate_Prediction_Variables(){
		Wj = new double[Hn];
		Cj = new double[Hn];
		Bet = new double[Hn];
		Vij = new double[In][Hn];  
		EIiVij = new double[Hn];
		Hj=new double[Hn];
		Ii = new double[In];
		GBmax = new double[In+1]; 
		GBmin = new double[In+1];
		GBave = new double[In+1];
		col = new String[In+1];
		return this;
	}

	public MYNNBP Read_Weights_Factors_and_Bias_from_text(String File_to_Read){
		ArrayList WFB = upd.Read(File_to_Read);
		int row_i=0;
		In = (int) upd.get_double(WFB.get(row_i).toString());
		row_i++;
		Hn = (int) upd.get_double(WFB.get(row_i).toString());
		Initiate_Prediction_Variables();
		row_i++;
		Alp = upd.get_double(WFB.get(row_i).toString());
		row_i++;
		b = upd.get_double(WFB.get(row_i).toString());
		row_i++;
		for (int j=0;j<Hn;j++){
			Wj[j]=upd.get_double(WFB.get(row_i).toString());
			row_i++;
			Cj[j]=upd.get_double(WFB.get(row_i).toString());
			row_i++;
			Bet[j] = upd.get_double(WFB.get(row_i).toString());
			row_i++;
			for (int i=0;i<In;i++){
				Vij[i][j]=upd.get_double(WFB.get(row_i).toString());   
				row_i++;
			}
		}
		
		for (int i=0;i<In+1;i++){
			GBmax[i]=upd.get_double(WFB.get(row_i).toString()); 
			row_i++;
			GBmin[i]=upd.get_double(WFB.get(row_i).toString());
			row_i++;
		}
		for (int i=0;i<In+1;i++){
			col[i] = WFB.get(row_i).toString();
			row_i++;
		}
		return this;    
	}

	public MYNNBP Prepare_Prediction_Data_Set(String DataFile){
		row= upd.Read(DataFile);
		Kn = row.size()-1;
		Input = new double[Kn][In];
		Output = new double[Kn];
		dataholder=new String[In];
		for (int k=0;k<Kn;k++){
			dataholder = row.get(k+1).toString().split("\t");
			for (int i=0;i<In;i++){
				Input[k][i] = Double.parseDouble(dataholder[i]);
			}
			Output[k]=Double.parseDouble(dataholder[In]);
		}

		for (int k=0;k<Kn;k++){
			for (int i=0;i<In;i++){
				Input[k][i]=2*(Input[k][i]-GBmin[i])/(GBmax[i]-GBmin[i])-1;
			}
		}
		return this;
	}

	public MYNNBP Test_Validation_Set(String Test_set){
		ArrayList rowV= upd.Read(Test_set);
		int KnV = rowV.size()-1;
		double[][] InputV = new double[KnV][In];
		String[] dataholderV = new String[In];
		double[] OutputV = new double[KnV];
		for (int k=0;k<KnV;k++){
			dataholderV = rowV.get(k+1).toString().split("\t");
			for (int i=0;i<In;i++){
				InputV[k][i] = Double.parseDouble(dataholderV[i]);
			}
			OutputV[k]=Double.parseDouble(dataholderV[In]);
		}

		for (int k=0;k<KnV;k++){
			for (int i=0;i<In;i++){
				InputV[k][i]=2*(InputV[k][i]-GBmin[i])/(GBmax[i]-GBmin[i])-1;  
			}
			OutputV[k]=2*(OutputV[k]-GBmin[In])/(GBmax[In]-GBmin[In])-1;
		}

		double SSEV = 0;
		for (int k=0;k<KnV;k++){
			double Out = Estimate_Out(InputV[k]);
			SSEV = SSEV + 0.5*Math.pow((OutputV[k]-Out),2);
		}
		this.SSEV = SSEV;
		System.out.println("SSE from Validation ="+SSEV+"\t iteration ="+miter);////
		return this;
	}

	double SSE_from_prediction = 0;
	double SST_from_prediction = 0;
	double Rsquared = 0;
	String Prediction_output = "";
	
	public MYNNBP Predict_Properties(){
		String outpre = "";
		double Ave = 0;
		double Exy = 0;
		double Ex = 0;
		double Ey = 0;
		double Ex2 = 0;
		double Ey2 = 0;
		for(int k=0;k<Kn;k++){
			Ave = Ave + Output[k];
		}
		Ave = Ave/Kn;
	
		upd.Rewrite(Prediction_output,"");
		for (int k=0;k<Kn;k++){
			double Out = (Estimate_Out(Input[k])+1)*(GBmax[In]-GBmin[In])/2+GBmin[In];
			SSE_from_prediction = SSE_from_prediction + Math.pow(Output[k]-Out,2);
			SST_from_prediction = SST_from_prediction + Math.pow(Output[k]-Ave,2);
			Exy = Exy + Output[k]*Out;
			Ex = Ex + Output[k];
			Ey = Ey + Out;
			Ex2 = Ex2 + Output[k]*Output[k];
			Ey2 = Ey2 + Out*Out;			
			outpre = outpre + Output[k] + "\t" + Out +"\r\n";
		}		
		Rsquared = Math.pow((Kn*Exy-Ex*Ey)/Math.sqrt((Kn*Ex2-Ex*Ex)*(Kn*Ey2-Ey*Ey)),2);
		upd.Writer(Prediction_output,"SSE = "+SSE_from_prediction+" R^2 = "+Rsquared);
		upd.Writer(Prediction_output,"True value\tEstimated value");
		upd.Writer(Prediction_output,outpre);
		return this;
	}

	public String Print_Equation(){
		Read_Weights_Factors_and_Bias_from_text(Weights_Factors_and_Bias);
		String Hj="";
		for (int j=0;j<Hn;j++){
			Hj=Vij[0][j]+"*Ii["+1+"]";
			for (int i=1;i<In;i++){
				int hh=i+1;
				Hj=Hj+"+"+Vij[i][j]+"*Ii["+hh+"]";   
			}
			Hj="Math.tanh("+Bet[j]+"*("+Hj+")"+Cj[j]+")";
		}
		String out=Wj[0]+"*("+Hj+")";
		for (int j=1;j<Hn;j++){
			out=out+"+"+Wj[j]+"*("+Hj+")";
		}
		out="Math.tanh("+Alp+"*("+out+")"+b+")";
		System.out.println("Property = "+out);
		return out;
	}

	double SSE_criteria;
	double SSE_old = 1.E+100;
	double SSEV=1.E+100;
	String Valid_set = "";

	int miter = 0;
	int piter = 0;
	int pitermax = 100;
	public void Process_ANN_Training(boolean Valid, boolean rand,int hidden){
		Initiate_Training_Variables(Training_set,hidden).Prepare_Training_Data_Set().Normalize_Data();
		if (rand ==true){
			Randomized_Weights_Factors_Bias();
		}
		else if (rand ==false){
			Read_Weights_Factors_and_Bias_from_text(Weights_Factors_and_Bias);
		}
		Initiate_Delta_Weights().Calculate_Output_and_Derivatives().Calculate_Weights_Factors_and_Bias();
		
		while (this.SSE>SSE_criteria){
			miter++;			
			if (Valid==true){
				Test_Validation_Set(Valid_set);
				if (SSE_old >= this.SSEV){
					oAlp = Alp;
					oBet = Bet;
					ob = b;
					oVij = Vij;
					oWj = Wj;
					oCj = Cj;
					nu = nu/1.0005;
					SSE_old = this.SSEV;	
					Print_Architecture_Weights_Factors_and_Bias_to_text(Weights_Factors_and_Bias);
				}else{
					if(piter<pitermax){				
						if(miter<=5){
							Alp = oAlp;
							Bet = oBet;
							b = ob;
							Vij = oVij;
							Wj = oWj;
							Cj = oCj;
							nu = nu*1.0005;
						}
						if(miter>1500){
							Randomized_Weights_Factors_Bias();
							Initiate_Delta_Weights();
							miter = 0;
							nu = 5.0;
							momentum = Math.random();
							Learn_rate_Weight = Math.random();
							piter++;
							//System.out.println(piter);
						}
					}else{						
						piter = 0;
						miter = 0;
						break;
					}
				}
			} else {
				if (SSE_old > this.SSE){
					oAlp = Alp;
					oBet = Bet;
					ob = b;
					oVij = Vij;
					oWj = Wj;
					oCj = Cj;
					nu = nu/1.0005;
					SSE_old = this.SSE;	
					Print_Architecture_Weights_Factors_and_Bias_to_text(Weights_Factors_and_Bias);
				}
				else{
					if(piter<pitermax){
						if(miter<=5){
							Alp = oAlp;
							Bet = oBet;
							b = ob;
							Vij = oVij;
							Wj = oWj;
							Cj = oCj;
							nu = nu*1.0005;
						}
						if(miter>1500){
							Randomized_Weights_Factors_Bias();
							Initiate_Delta_Weights();
							miter = 0;
							nu = 5.0;
							momentum = Math.random();
							Learn_rate_Weight = Math.random();
							piter++;
							//System.out.println(piter);
						}
					}else{						
						piter = 0;
						miter = 0;
						break;
					}
				}
			}
			Calculate_Output_and_Derivatives().Calculate_Weights_Factors_and_Bias();
		}
	}

	public void Process_ANN_Prediction(){
		Read_Weights_Factors_and_Bias_from_text(Weights_Factors_and_Bias).Prepare_Prediction_Data_Set(Prediction_set).Predict_Properties();
	}

}

public class NN7 {
	public static void main(String args[]) {   
	System.out.println("Learning process started");
	long startTime = System.nanoTime();
	int i = 8;
	//for(int i=1;i<=100;i++){
		MYNNBP Faji=new MYNNBP();
		Faji.Training_set = "NO2.dat";
		Faji.Valid_set = "NO2_valid.dat";
		Faji.Prediction_set = "NO2_valid.dat";
		Faji.Prediction_output = "NO2_valid_checkH_"+i+".dat";
		Faji.SSE_criteria = 0.0001;
		Faji.pitermax = 5;
		Faji.momentum = 0.07;
		Faji.nu = 0.1;
		Faji.Learn_rate_Weight = 0.02;
		Faji.Weights_Factors_and_Bias = "Weights_Factors_and_Bias_for_NO2H_"+i+".dat";
		Faji.Process_ANN_Training(true,true,i);	
		Faji.Process_ANN_Prediction();
		long endTime = System.nanoTime();
		long duration = (endTime - startTime)/1000000;
		System.out.println("Nuerons ="+i+" SSE = "+Faji.SSE_from_prediction+" R^2 = "+Faji.Rsquared+" Execution = "+duration+" ms");
	//}

	//Faji.Print_Equation();

	}
}