# source - tableau:
# https://stackoverflow.com/questions/75294027/why-is-my-tkinter-treeview-not-changing-colors
import requests
import tkinter as tk
from tkinter import ttk
from tkinter.messagebox import showinfo
from Details import Details


class Tableau(tk.Toplevel):
    
    def __init__(self, fenetre, titre_fenetre): # self: fenêtre tkToplevel - fenetre: fenetre mère - titre de la fenêtre)
        tk.Toplevel.__init__(self, fenetre) # Initialisation de la fenetrte parente
        self.title(titre_fenetre)
        self.resizable(width=False, height=False) # bloquer le redimensionnement
        self.geometry("700x300")  # Dimensions de la fenêtrefenetre_application("Fenêtre Secondaire")
        #self(width=False,height=False)
        self.liste_patients = []
        self.id_selectionne = None  # permet de récupéer l'ID sélectionnée au clic sur la ligne
        ## Tableau Triview
        # définir les colonnes du tableau
        columns = ('id','prenom', 'nom', 'adressePostale')
        self.tree = ttk.Treeview(self, columns=columns, show='headings')
        self.tree.grid(row=0, column=0, sticky='nsew')
        # sélection d'un enregistrement
        self.tree.bind('<<TreeviewSelect>>', self.select_id)
        self.numero_ligne=0
        
    def recuperation_donnees(self, url):

        # L'URL du serveur d'où récupérer les données JSON
        #self.url = 'http://127.0.0.1:5000/students' - table students - university

        # Envoyer la requête GET
        reponse = requests.get(url)

        if reponse.status_code == 200:
            # Transformer le format json en listes
            self.liste_patients = reponse.json()
            #print(self.liste_patients)
        else:
            print(f"Erreur lors de la récupération des données: {reponse.status_code}")
    
    def affichage_tableau(self):
            
        # style the widget
        s = ttk.Style()
        s.theme_use('clam')
        
        # definir les titres
        self.tree.heading('id', text='Id', anchor=tk.W)
        self.tree.heading('prenom', text='Prenom', anchor=tk.W)
        self.tree.heading('nom', text='Nom', anchor=tk.W)
        self.tree.heading('adressePostale', text='Adresse_Postale', anchor=tk.W)
        s.configure('Treeview.Heading', background="lightblue")

         #definir les colonnes
        self.tree.column('id', width=60, anchor=tk.W) # colonne de largeur 30 px et id à gauche (West)
        self.tree.column('prenom', width=150, anchor=tk.W)  
        self.tree.column('nom', width=150, anchor=tk.W)  
        self.tree.column('adressePostale', width=1000, anchor=tk.W)  

        # rentrer les données
        contacts = []
        i = 1
        for patient in self.liste_patients:  # C'est une liste de dictionnaire
            row_values = (patient['idPatient'], patient['prenom'], patient['nom'], patient['adressePostale'])
            i += 1
            if i % 2:
                
                self.tree.insert('', tk.END, values=row_values, tags=('oddrow',))
            else:
                self.tree.insert('', tk.END, values=row_values, tags=('evenrow',))
            
    def select_id(self, event):
        selected_items = self.tree.selection()  # Récupère la liste des éléments sélectionnés dans le Treeview.
        selected_item = selected_items[0]  # Prend uniquement le premier élément sélectionné.
        id = self.tree.item(selected_item, 'values')[0]  # Récupère l'ID, qui est la première valeur de l'élément sélectionné.
        ##print(id)  # Affiche l'ID de l'élément sélectionné.
        # ouverture de la fenêtre "Détails"
        details = Details(self, id)
        
    def habillage_tableau(self):
       # Création et configuration de la Scrollbar
        scrollbar = ttk.Scrollbar(self, orient=tk.VERTICAL, command=self.tree.yview)
        self.tree.configure(yscroll=scrollbar.set)
        scrollbar.grid(row=0, column=1, sticky='ns')

        # couleur des lignes
        self.tree.tag_configure('oddrow', background='lightgrey')
        self.tree.tag_configure('evenrow', background='white')

if __name__ == '__main__':       
    root = tk.Tk()
    root.title("fenêtre mère")
    tableau = Tableau(root, "TopLevel")
    tableau.recuperation_donnees('http://127.0.0.1/slim-secretariat-web/tous')
    tableau.affichage_tableau()
    tableau.habillage_tableau()
    root.mainloop()
    
    
    # Serveur Python Flask
    # adresse du serveur: http://127.0.0.1:5000/
    # libération du port 5000
    # lsof -i:5000
    # kill -9 PID 
    
    # serveur php
    # adresse du serveur: http://127.0.0.1:/