# source - tableau:
# https://stackoverflow.com/questions/75294027/why-is-my-tkinter-treeview-not-changing-colors
import requests
import tkinter as tk
from tkinter import ttk
from tkinter.messagebox import showinfo

class Tableau_patients(tk.Toplevel):
    
    def __init__(self, fenetre):
        tk.Toplevel.__init__(self, fenetre) # Initialisation de la fenêtre Toplevel avec 'fenetre' comme parent.
        self.title("Patients")
        self.geometry("700x400")  # Dimensions de la fenêtrefenetre_application("Fenêtre Secondaire")
        self.liste_patients = {}
        self.id_selectionne = None  # permet de récupéer l'ID sélectionnée par cli sur la ligne
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
        #self.url = 'http://127.0.0.1:8082/tableau'

        # Envoyer la requête GET
        reponse = requests.get(url)

        # Vérifier si la requête a réussi
        if reponse.status_code == 200:
            # Transformer le format json en listes
            donnees = reponse.json()
            print(donnees)
            if isinstance(donnees, dict):
                self.liste_patients = [donnees]  # transforme un dictionnaire (1 patient) en liste de 1 dictionnaire
                print(self.liste_patients)
            else:
                self.liste_patients = donnees
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
        item_id = self.tree.item(selected_item, 'values')[0]  # Récupère l'ID, qui est la première valeur de l'élément sélectionné.
        print(item_id)  # Affiche l'ID de l'élément sélectionné.
        self.id_selectionne = item_id  # Stocke l'ID de l'élément sélectionné dans une variable

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
    root.title("fenêtre principale")
    root.resizable(width=False,height=False)
    tableau = Tableau_patients(root)
    tableau.recuperation_donnees('http://127.0.0.1:5000/students')
    tableau.affichage_tableau()
    tableau.habillage_tableau()
    root.mainloop()
