from struct import pack
import tkinter as tk
from tkinter import ttk ## bibliothèque de widgets plus modernes tk
from datetime import datetime
import Frame_canevas
from Tableau import Tableau # importer la classe Tableau du fichiet Tableau.py

class Secretariat (tk.Tk):

    def __init__(self):
        """Construction de la fenêtre principale"""
        tk.Tk.__init__(self)   # constructeur de la classe parente
        # Frame des boutons en haut - position 0,0
        self.frame_boutons = ttk.Frame(self)
        self.frame_boutons.pack(side="top")
        self.frame_boutons.grid(row=0, column=0)
        # afficher les trois boutons en haut à gauche
        bouton_tous = ttk.Button(self.frame_boutons, text="Tous", command=self.tous)
        bouton_tous.pack(side="left", padx = 4, pady = 4 )
        bouton_suite =ttk.Button(self.frame_boutons, text="Sorties", command=self.sorties)
        bouton_suite.pack(side="left", padx = 4, pady = 4 )
        bouton_entrees =ttk.Button(self.frame_boutons, text="Entrees", command=self.entrees)
        bouton_entrees.pack(side="left", padx = 4, pady = 4 )
        # label de la date courante
        self.label_date = ttk.Label(self.frame_boutons)
        self.label_date.pack(padx=10,pady=8)
        self.afficher_heure_courante()
        # Framee du canvas partie intérieure de l'application
        self.frame_canvas = Frame_canevas.Frame_canevas(self)
        self.frame_canvas.grid(row=1,column=0)
       
    def tous(self):
        self.tableau = Tableau(self, "Tous")
        self.tableau.recuperation_donnees('http://localhost/soignemoi-web/tous')
        self.affichage()
        
    def sorties(self):
        self.tableau = Tableau(self, "Sorties")
        self.tableau.recuperation_donnees('http://localhost/soignemoi-web/sorties')
        self.affichage()
        
    def entrees(self):
        self.tableau = Tableau(self, "Entrées")
        self.tableau.recuperation_donnees('http://localhost/soignemoi-web/entrees')
        self.affichage()
        
    def affichage(self):
        self.tableau.affichage_tableau()
        self.tableau.habillage_tableau()
        
    def afficher_heure_courante(self):
        # obtenir la date du jour
        today = datetime.now()
        # définir la date du jour
        formatted_date = today.strftime("%d-%m-%Y")
        # affecter la  date au label
        self.label_date.config(text=formatted_date)

    # ----------------------------------------------------
        
if __name__ == '__main__':
    App=Secretariat()
    App.resizable(width=False,height=False)
    App.title('Secretariat')
    App.mainloop()
    
 
